@extends('layouts.app')

@section('title', 'Pesanan Diterima #' . $order->order_number . ' - Kopi Gacoan')

@section('content')
<div class="py-16 bg-[#0D0D11] min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Success Card -->
        <div class="bg-[#16161C] border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl space-y-8 relative overflow-hidden">
            
            <!-- Top Animated Badge -->
            <div class="text-center space-y-3">
                <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-400 p-1 mx-auto shadow-xl shadow-emerald-500/20 flex items-center justify-center">
                    <div class="w-full h-full bg-[#121216] rounded-full flex items-center justify-center">
                        <i class="ph ph-mug-hot text-3xl text-emerald-400"></i>
                    </div>
                </div>

                <span class="inline-block px-3.5 py-1 rounded-full text-xs font-black bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 uppercase tracking-widest">
                    PESANAN BERHASIL DIBUAT
                </span>

                <h1 class="font-display font-black text-2xl sm:text-3xl text-white">
                    Terima Kasih, {{ $order->customer_name }}! 🔥
                </h1>
                <p class="text-xs sm:text-sm text-gray-400 max-w-md mx-auto">
                    Pesananmu sedang langsung diseduh dan disiapkan oleh Barista Squad Kopi Gacoan!
                </p>
            </div>

            <!-- Order ID & Status Tracker Bar -->
            <div class="bg-[#0D0D11] border border-white/10 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] text-gray-500 uppercase font-extrabold tracking-wider block">Nomor Pesanan</span>
                    <span class="font-mono font-black text-lg text-[#FFDE59] tracking-wider">{{ $order->order_number }}</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('order.track', $order->order_number) }}" class="inline-flex items-center gap-2 bg-[#FF2E63] hover:bg-[#e01e53] text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-lg transition-all">
                        <i class="ph ph-radar text-xs animate-spin"></i>
                        <span>Lacak Status Live</span>
                    </a>
                </div>
            </div>

            <!-- Receipt Details -->
            <div class="space-y-4 text-xs text-gray-300">
                <h3 class="font-display font-bold text-sm text-white uppercase tracking-wider border-b border-white/10 pb-2">
                    Rincian Pesanan
                </h3>

                <div class="grid grid-cols-2 gap-3 text-gray-400">
                    <div>
                        <span class="block text-gray-500">Lokasi Outlet:</span>
                        <strong class="text-white">{{ $order->outlet?->name }}</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Layanan / Meja:</span>
                        <strong class="text-white">{{ strtoupper($order->order_type) }} {{ $order->table_number ? '('.$order->table_number.')' : '' }}</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Metode Pembayaran:</span>
                        <strong class="text-white uppercase">{{ $order->payment_method }} ({{ strtoupper($order->payment_status) }})</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Waktu Order:</span>
                        <strong class="text-white">{{ $order->created_at->format('d M Y, H:i') }} WIB</strong>
                    </div>
                </div>

                <!-- Items Breakdown -->
                <div class="space-y-2.5 pt-3 border-t border-white/10">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="font-bold text-white">{{ $item->quantity }}x {{ $item->product->name }}</span>
                                <span class="text-[11px] text-gray-400 block">{{ $item->sugar_level }} • {{ $item->ice_level }} {{ $item->extra_shots > 0 ? '• +'.$item->extra_shots.' Shot' : '' }}</span>
                            </div>
                            <span class="font-bold text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Calculations -->
                <div class="pt-4 border-t border-white/10 space-y-1.5 text-gray-400">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="flex justify-between text-emerald-400 font-bold">
                            <span>Diskon ({{ $order->voucher_code }})</span>
                            <span>-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span>Pajak Restoran PB1</span>
                        <span>Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="pt-2 border-t border-white/10 flex justify-between text-sm font-extrabold text-white">
                        <span>Total Bayar</span>
                        <span class="text-[#FF2E63] text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons: WhatsApp and Back Home -->
            <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-black py-3.5 px-5 rounded-2xl shadow-lg shadow-emerald-500/20 transition-all">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>Konfirmasi ke WhatsApp Outlet</span>
                </a>
                <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 bg-white/5 hover:bg-white/10 text-gray-200 hover:text-white text-xs font-bold py-3.5 px-5 rounded-2xl border border-white/10 transition-colors">
                    <i class="ph ph-house"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
