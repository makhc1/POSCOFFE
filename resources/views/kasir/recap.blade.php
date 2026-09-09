@extends('layouts.kasir')

@section('title', 'Rekap Penjualan Shift - Kopi Gacoan POS')

@section('content')
<div class="p-6 space-y-6 bg-[#0D0D11] min-h-[calc(100vh-61px)]">
    
    <div>
        <h1 class="font-display font-black text-2xl sm:text-3xl text-white">Rekap Penjualan Kasir Hari Ini 📊</h1>
        <p class="text-xs text-gray-400 mt-1">Laporan transaksi shift {{ date('d F Y') }} untuk kasir & barista.</p>
    </div>

    <!-- 3 Summary Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-[#16161C] border border-white/10 rounded-3xl p-6 space-y-2">
            <span class="text-xs font-bold text-gray-400 uppercase block">Total Omset Hari Ini</span>
            <span class="font-display font-black text-2xl text-emerald-400 block">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            <span class="text-[10px] text-gray-500">{{ count($todayOrders) }} Transaksi Berhasil</span>
        </div>

        <div class="bg-[#16161C] border border-white/10 rounded-3xl p-6 space-y-2">
            <span class="text-xs font-bold text-gray-400 uppercase block">Total Penerimaan Uang Tunai</span>
            <span class="font-display font-black text-2xl text-[#FF9900] block">Rp {{ number_format($totalCash, 0, ',', '.') }}</span>
            <span class="text-[10px] text-gray-500">Uang Fisik Kasir (Cash Drawer)</span>
        </div>

        <div class="bg-[#16161C] border border-white/10 rounded-3xl p-6 space-y-2">
            <span class="text-xs font-bold text-gray-400 uppercase block">Total QRIS & Non-Tunai</span>
            <span class="font-display font-black text-2xl text-cyan-400 block">Rp {{ number_format($totalNonCash, 0, ',', '.') }}</span>
            <span class="text-[10px] text-gray-500">QRIS, E-Wallet & Transfer Bank</span>
        </div>
    </div>

    <!-- Today's Orders Table -->
    <div class="bg-[#16161C] border border-white/10 rounded-3xl p-6 shadow-xl space-y-4">
        <h3 class="font-display font-bold text-lg text-white">Daftar Transaksi Shift</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-gray-300">
                <thead class="bg-white/5 uppercase text-[10px] font-bold text-gray-400 tracking-wider">
                    <tr>
                        <th class="p-3.5 rounded-l-xl">No. Order</th>
                        <th class="p-3.5">Waktu</th>
                        <th class="p-3.5">Pelanggan</th>
                        <th class="p-3.5">Item</th>
                        <th class="p-3.5">Metode Bayar</th>
                        <th class="p-3.5 rounded-r-xl text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($todayOrders as $o)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-3.5 font-mono font-bold text-[#FFDE59]">{{ $o->order_number }}</td>
                            <td class="p-3.5 text-gray-400">{{ $o->created_at->format('H:i:s') }} WIB</td>
                            <td class="p-3.5 font-bold text-white">{{ $o->customer_name }}</td>
                            <td class="p-3.5">{{ $o->items->sum('quantity') }} Item</td>
                            <td class="p-3.5">
                                <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase {{ $o->payment_method === 'cash' ? 'bg-[#FF9900]/20 text-[#FF9900]' : 'bg-cyan-500/20 text-cyan-400' }}">
                                    {{ $o->payment_method }}
                                </span>
                            </td>
                            <td class="p-3.5 text-right font-extrabold text-[#FF2E63]">
                                Rp {{ number_format($o->total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">Belum ada transaksi hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
