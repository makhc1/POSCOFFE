@extends('layouts.admin')

@section('title', 'Manajemen Pesanan - Admin Kopi Gacoan')

@section('content')
<div class="space-y-6">
    
    <div>
        <h1 class="font-display font-black text-2xl text-white">Semua Transaksi & Pesanan Masuk</h1>
        <p class="text-xs text-gray-400 mt-1">Kelola antrean penyeduhan barista dan status pengiriman ke meja pelanggan.</p>
    </div>

    <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-gray-300">
                <thead class="bg-white/5 uppercase text-[10px] font-bold text-gray-400 tracking-wider">
                    <tr>
                        <th class="p-3.5 rounded-l-xl">No. Order</th>
                        <th class="p-3.5">Pelanggan & Kontak</th>
                        <th class="p-3.5">Layanan / Lokasi</th>
                        <th class="p-3.5">Detail Item Dipesan</th>
                        <th class="p-3.5">Total & Pembayaran</th>
                        <th class="p-3.5">Status Pesanan</th>
                        <th class="p-3.5 rounded-r-xl">Ubah Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($orders as $order)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-3.5 font-mono font-bold text-[#FFDE59]">
                                <a href="{{ route('order.track', $order->order_number) }}" target="_blank" class="hover:underline">
                                    {{ $order->order_number }}
                                </a>
                                <span class="block text-[10px] text-gray-500 font-normal mt-0.5">{{ $order->created_at->format('d/m/y H:i') }}</span>
                            </td>
                            <td class="p-3.5">
                                <span class="font-bold text-white block">{{ $order->customer_name }}</span>
                                <span class="text-[11px] text-gray-400">{{ $order->customer_phone }}</span>
                                @if($order->customer_email)
                                    <span class="block text-[10px] text-gray-500">{{ $order->customer_email }}</span>
                                @endif
                            </td>
                            <td class="p-3.5">
                                <span class="font-bold uppercase text-white block">{{ $order->order_type }}</span>
                                <span class="text-[10px] text-[#FF9900]">{{ $order->table_number ?? $order->outlet?->name }}</span>
                                @if($order->delivery_address)
                                    <span class="block text-[10px] text-gray-400 max-w-xs truncate">{{ $order->delivery_address }}</span>
                                @endif
                            </td>
                            <td class="p-3.5">
                                <div class="space-y-1 max-w-xs">
                                    @foreach($order->items as $item)
                                        <div class="text-[11px]">
                                            <span class="font-bold text-white">{{ $item->quantity }}x</span> {{ $item->product->name }}
                                            <span class="text-[10px] text-gray-500">({{ $item->sugar_level }}, {{ $item->ice_level }})</span>
                                        </div>
                                    @endforeach
                                    @if($order->notes)
                                        <div class="text-[10px] text-[#FF9900] italic mt-1">"{{ $order->notes }}"</div>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3.5">
                                <span class="font-extrabold text-[#FF2E63] text-sm block">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-gray-400 uppercase">{{ $order->payment_method }} • {{ $order->payment_status }}</span>
                            </td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $order->status_info['badge'] }}">
                                    {{ $order->status_info['label'] }}
                                </span>
                            </td>
                            <td class="p-3.5">
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-[#09090C] border border-white/10 rounded-lg px-2 py-1.5 text-[11px] text-gray-200 focus:outline-none">
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
                            <td colspan="7" class="p-8 text-center text-gray-500">Belum ada pesanan terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $orders->links() }}
        </div>
    </div>

</div>
@endsection
