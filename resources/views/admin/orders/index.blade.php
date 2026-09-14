@extends('layouts.admin')

@section('title', 'Manajemen Pesanan - Bagelan Coffee')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto opacity-0 translate-y-16" style="animation: fadeUp 1s cubic-bezier(0.32, 0.72, 0, 1) forwards;">
    
    <div class="flex flex-col sm:flex-row justify-between sm:items-end gap-6 mb-4">
        <div>
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-[1px] bg-[#2D2420]/30"></span>
                <span class="text-[10px] font-semibold uppercase tracking-[0.3em] text-[#2D2420]/60">Operasional Transaksi</span>
            </div>
            <h1 class="font-editorial text-4xl text-[#2D2420] leading-tight">Sirkulasi Pesanan.</h1>
        </div>
    </div>

    <!-- Editorial Double-Bezel Table Container -->
    <div class="bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2.5rem] p-1.5 shadow-[0_20px_40px_rgba(45,36,32,0.05)] relative overflow-hidden">
        <div class="bg-[#FDFBF7] shadow-[inset_0_1px_2px_rgba(255,255,255,1)] rounded-[calc(2.5rem-0.375rem)] border border-[#2D2420]/5 p-6 sm:p-10 relative z-10">
            
            <div class="overflow-x-auto hide-scrollbar">
                <table class="w-full text-left text-sm text-[#2D2420]">
                    <thead class="uppercase text-[9px] font-bold text-[#2D2420]/40 tracking-widest border-b border-[#2D2420]/10">
                        <tr>
                            <th class="pb-6">No. Referensi</th>
                            <th class="pb-6">Pelanggan</th>
                            <th class="pb-6">Distribusi</th>
                            <th class="pb-6">Detail Racikan</th>
                            <th class="pb-6">Tagihan</th>
                            <th class="pb-6">Progres</th>
                            <th class="pb-6 text-right">Perbarui Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2D2420]/5">
                        @forelse($orders as $order)
                            <tr class="group hover:bg-[#2D2420]/[0.02] awwwards-transition">
                                <td class="py-6 pr-4">
                                    <a href="{{ route('order.track', $order->order_number) }}" target="_blank" class="font-mono font-bold text-[#8D6E63] hover:text-[#4E342E] awwwards-transition block mb-1">
                                        {{ $order->order_number }}
                                    </a>
                                    <span class="text-[9px] text-[#2D2420]/50 font-semibold tracking-wider uppercase">{{ $order->created_at->format('d/m/y H:i') }}</span>
                                </td>
                                <td class="py-6 pr-4">
                                    <span class="font-bold text-[#2D2420] block">{{ $order->customer_name }}</span>
                                    <span class="text-[10px] text-[#2D2420]/60">{{ $order->customer_phone }}</span>
                                </td>
                                <td class="py-6 pr-4">
                                    <span class="font-bold uppercase text-[10px] tracking-widest text-[#2D2420] block mb-0.5">{{ str_replace('_', ' ', $order->order_type) }}</span>
                                    <span class="text-[11px] text-[#8D6E63] font-semibold">{{ $order->table_number ?? $order->outlet?->name }}</span>
                                </td>
                                <td class="py-6 pr-4 min-w-[200px]">
                                    <div class="space-y-1.5 max-w-xs">
                                        @foreach($order->items as $item)
                                            <div class="text-[11px] leading-tight flex items-start gap-1">
                                                <span class="font-bold text-[#2D2420] shrink-0">{{ $item->quantity }}x</span> 
                                                <span class="text-[#2D2420]/80">
                                                    {{ $item->product->name }}
                                                    <span class="text-[9px] text-[#2D2420]/40 block mt-0.5">({{ $item->sugar_level }}, {{ $item->ice_level }})</span>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="py-6 pr-4">
                                    <span class="font-bold text-[#2D2420] text-sm block mb-1">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    <span class="text-[9px] font-bold text-[#2D2420]/40 uppercase tracking-widest">{{ $order->payment_method }} • {{ $order->payment_status }}</span>
                                </td>
                                <td class="py-6 pr-4">
                                    @php
                                        $statusStyles = [
                                            'pending' => 'bg-[#2D2420]/5 text-[#2D2420]/60 border-[#2D2420]/10',
                                            'brewing' => 'bg-[#8D6E63]/10 text-[#4E342E] border-[#8D6E63]/20',
                                            'ready' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'completed' => 'bg-[#2D2420] text-[#FDFBF7] border-transparent',
                                            'cancelled' => 'bg-[#FF2E63]/5 text-[#FF2E63] border-[#FF2E63]/10',
                                        ];
                                        $style = $statusStyles[$order->status] ?? $statusStyles['pending'];
                                    @endphp
                                    <span class="px-3 py-1.5 rounded-full text-[9px] font-bold tracking-widest uppercase border {{ $style }}">
                                        {{ $order->status_info['label'] }}
                                    </span>
                                </td>
                                <td class="py-6 text-right relative">
                                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="relative group/form inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <i class="ph ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#2D2420]/40 group-focus-within/form:text-[#2D2420] awwwards-transition"></i>
                                        <select name="status" onchange="this.form.submit()" class="appearance-none bg-[#FAF7F2] border border-[#2D2420]/10 hover:border-[#2D2420]/30 rounded-xl pl-4 pr-8 py-2 text-[11px] font-semibold text-[#2D2420] focus:outline-none cursor-pointer awwwards-transition">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="brewing" {{ $order->status === 'brewing' ? 'selected' : '' }}>Sedang Diseduh</option>
                                            <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Siap Diambil</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batalkan</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-[#2D2420]/40 font-light text-sm">Belum ada pesanan terdaftar di sistem.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pt-8">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(2rem); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
