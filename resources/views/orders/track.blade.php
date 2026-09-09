@extends('layouts.app')

@section('title', 'Lacak Status Pesanan - Kopi Gacoan')
@section('meta_description', 'Lacak status penyeduhan dan pengiriman pesanan Kopi Gacoan kamu secara langsung (real-time).')

@section('content')
<div class="py-12 bg-[#0D0D11] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-xl mx-auto mb-10 space-y-2">
            <span class="text-xs font-black text-[#FF9900] uppercase tracking-widest block">LIVE ORDER TRACKER</span>
            <h1 class="font-display font-black text-3xl sm:text-4xl text-white">Lacak Pesanan Kopi Gacoan 🛵☕</h1>
            <p class="text-xs text-gray-400">Masukkan nomor pesananmu untuk memantau proses penyeduhan barista dan kesiapan pesanan.</p>
        </div>

        <!-- Search Bar -->
        <div class="bg-[#16161C] border border-white/10 rounded-2xl p-4 mb-10 shadow-xl max-w-2xl mx-auto">
            <form method="GET" action="{{ route('order.track') }}" class="flex gap-2">
                <div class="relative flex-grow">
                    <i class="ph ph-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" name="order_number" value="{{ $searchNumber }}" placeholder="Masukkan No. Pesanan (Contoh: GC-202609-8899)" class="w-full bg-[#0D0D11] border border-white/10 focus:border-[#FF2E63] rounded-xl pl-10 pr-4 py-3 text-xs text-white uppercase placeholder:normal-case focus:outline-none" required>
                </div>
                <button type="submit" class="bg-gradient-to-r from-[#FF2E63] to-[#FF9900] text-white text-xs font-black px-6 py-3 rounded-xl shadow-lg transition-transform hover:scale-105 shrink-0">
                    Lacak Order
                </button>
            </form>
        </div>

        @if($order)
            <!-- Order Tracking Results Card -->
            <div class="bg-[#16161C] border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl space-y-8 animate-fade-in">
                
                <!-- Order Header Info -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-white/10">
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase font-extrabold block">Status Pesanan Terkini</span>
                        <div class="flex items-center gap-2.5 mt-1">
                            <span class="font-mono font-black text-xl text-[#FFDE59]">{{ $order->order_number }}</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $order->status_info['badge'] }}">
                                {{ $order->status_info['label'] }}
                            </span>
                        </div>
                    </div>
                    <div class="text-left sm:text-right">
                        <span class="text-xs text-gray-400 block">Pemesan: <strong class="text-white">{{ $order->customer_name }}</strong></span>
                        <span class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                </div>

                <!-- 4-Step Visual Progress Tracker -->
                @php
                    $step = $order->status_info['step'];
                @endphp
                <div class="py-4">
                    <div class="relative flex items-center justify-between">
                        
                        <!-- Connecting Line -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 w-full bg-[#0D0D11] z-0">
                            <div class="h-full bg-gradient-to-r from-[#FF2E63] to-[#FF9900] transition-all duration-700" style="width: {{ match($step) { 1 => '15%', 2 => '50%', 3 => '85%', 4 => '100%', default => '0%' } }}"></div>
                        </div>

                        <!-- Step 1 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-sm border-2 {{ $step >= 1 ? 'bg-[#FF2E63] text-white border-[#FF2E63] shadow-lg shadow-[#FF2E63]/40' : 'bg-[#0D0D11] text-gray-500 border-white/10' }}">
                                <i class="ph ph-receipt"></i>
                            </div>
                            <span class="text-[11px] font-bold text-white mt-2">Diterima</span>
                            <span class="text-[9px] text-gray-400">Order Terverifikasi</span>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-sm border-2 {{ $step >= 2 ? 'bg-[#FF9900] text-white border-[#FF9900] shadow-lg shadow-[#FF9900]/40 animate-pulse' : 'bg-[#0D0D11] text-gray-500 border-white/10' }}">
                                <i class="ph ph-mug-hot"></i>
                            </div>
                            <span class="text-[11px] font-bold text-white mt-2">Diseduh</span>
                            <span class="text-[9px] text-gray-400">Barista Meracik</span>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-sm border-2 {{ $step >= 3 ? 'bg-cyan-500 text-white border-cyan-500 shadow-lg shadow-cyan-500/40' : 'bg-[#0D0D11] text-gray-500 border-white/10' }}">
                                <i class="ph ph-bell-concierge"></i>
                            </div>
                            <span class="text-[11px] font-bold text-white mt-2">Siap</span>
                            <span class="text-[9px] text-gray-400">Di Meja / Diantar</span>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-sm border-2 {{ $step >= 4 ? 'bg-emerald-500 text-white border-emerald-500 shadow-lg shadow-emerald-500/40' : 'bg-[#0D0D11] text-gray-500 border-white/10' }}">
                                <i class="ph ph-circle-check"></i>
                            </div>
                            <span class="text-[11px] font-bold text-white mt-2">Selesai</span>
                            <span class="text-[9px] text-gray-400">Selamat Menikmati!</span>
                        </div>

                    </div>
                </div>

                <!-- Order Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-white/10 text-xs">
                    <div class="space-y-3 bg-[#0D0D11] p-5 rounded-2xl border border-white/10">
                        <h4 class="font-bold text-white uppercase text-xs tracking-wider flex items-center gap-2">
                            <i class="ph ph-shop text-[#FF9900]"></i>
                            <span>Outlet & Layanan</span>
                        </h4>
                        <p class="text-gray-300"><strong>Outlet:</strong> {{ $order->outlet?->name }}</p>
                        <p class="text-gray-300"><strong>Alamat:</strong> {{ $order->outlet?->address }}</p>
                        <p class="text-gray-300"><strong>Layanan:</strong> {{ strtoupper($order->order_type) }} {{ $order->table_number ? '('.$order->table_number.')' : '' }}</p>
                    </div>

                    <div class="space-y-3 bg-[#0D0D11] p-5 rounded-2xl border border-white/10">
                        <h4 class="font-bold text-white uppercase text-xs tracking-wider flex items-center gap-2">
                            <i class="ph ph-list-check text-[#FF2E63]"></i>
                            <span>Menu Dipesan</span>
                        </h4>
                        <div class="space-y-1.5 max-h-32 overflow-y-auto">
                            @foreach($order->items as $item)
                                <div class="flex justify-between text-gray-300">
                                    <span>{{ $item->quantity }}x {{ $item->product->name }}</span>
                                    <span class="font-bold text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="pt-2 border-t border-white/10 flex justify-between font-bold text-white">
                            <span>Total Tagihan:</span>
                            <span class="text-[#FF2E63]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Refresh Button -->
                <div class="text-center pt-2">
                    <button onclick="window.location.reload()" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-white bg-white/5 hover:bg-white/10 px-4 py-2.5 rounded-xl border border-white/10 transition-colors">
                        <i class="ph ph-arrows-rotate"></i>
                        <span>Perbarui Status Real-Time</span>
                    </button>
                </div>

            </div>
        @elseif($searchNumber)
            <div class="text-center py-16 bg-[#16161C] rounded-3xl border border-white/10 p-8">
                <i class="ph ph-circle-question text-4xl text-gray-500 mb-3"></i>
                <h3 class="font-display font-bold text-xl text-white">Pesanan Tidak Ditemukan</h3>
                <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto">Pastikan nomor pesanan yang kamu masukkan sudah benar (contoh: <code>GC-202609-8899</code>).</p>
            </div>
        @endif

    </div>
</div>
@endsection
