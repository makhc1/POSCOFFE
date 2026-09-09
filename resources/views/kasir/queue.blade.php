@extends('layouts.kasir')

@section('title', 'Antrean Barista (KDS) - Kopi Gacoan')

@section('content')
<div class="p-6 space-y-6 bg-[#0D0D11] min-h-[calc(100vh-61px)]">
    
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="font-display font-black text-2xl sm:text-3xl text-white flex items-center gap-2.5">
                <i class="ph ph-mug-hot text-[#FF2E63]"></i>
                <span>Antrean Barista & Kitchen Display System (KDS)</span>
            </h1>
            <p class="text-xs text-gray-400 mt-1">Pantau pesanan aktif dan ubah status peracikan secara langsung.</p>
        </div>

        <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 rounded-xl bg-[#FF2E63]/20 text-[#FF2E63] text-xs font-black border border-[#FF2E63]/30 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-[#FF2E63] animate-ping"></span>
                <span>{{ count($activeOrders) }} Antrean Aktif</span>
            </span>
            <button onclick="window.location.reload()" class="bg-white/5 hover:bg-white/10 text-white text-xs font-bold px-3.5 py-2 rounded-xl border border-white/10 transition-colors flex items-center gap-1.5">
                <i class="ph ph-rotate text-xs"></i>
                <span>Refresh</span>
            </button>
        </div>
    </div>

    <!-- Active Orders Ticket Grid -->
    @if($activeOrders->isEmpty())
        <div class="text-center py-20 bg-[#16161C] rounded-3xl border border-white/10 p-8 max-w-md mx-auto">
            <div class="w-16 h-16 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl mx-auto mb-3">
                <i class="ph ph-check-double"></i>
            </div>
            <h3 class="font-display font-bold text-lg text-white">Semua Antrean Bersih!</h3>
            <p class="text-xs text-gray-400 mt-1">Belum ada pesanan baru yang menunggu penyeduhan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($activeOrders as $order)
                <div class="bg-[#16161C] border {{ $order->status === 'brewing' ? 'border-[#FF9900]/50 shadow-lg shadow-[#FF9900]/10' : 'border-white/10' }} rounded-3xl p-5 flex flex-col justify-between space-y-4 hover:border-white/30 transition-all">
                    
                    <!-- Ticket Header -->
                    <div>
                        <div class="flex justify-between items-start pb-3 border-b border-white/10">
                            <div>
                                <span class="font-mono font-black text-base text-[#FFDE59] block">{{ $order->order_number }}</span>
                                <span class="text-xs font-bold text-white">{{ $order->customer_name }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-black uppercase px-2 py-1 rounded-md {{ $order->order_type === 'dine_in' ? 'bg-[#FF2E63]/20 text-[#FF2E63]' : 'bg-[#FF9900]/20 text-[#FF9900]' }}">
                                    {{ strtoupper($order->order_type) }} {{ $order->table_number ? '('.$order->table_number.')' : '' }}
                                </span>
                                <span class="text-[10px] text-gray-500 block mt-1">{{ $order->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <!-- Ticket Items List -->
                        <div class="py-3 space-y-2.5 text-xs text-gray-200">
                            @foreach($order->items as $it)
                                <div class="p-2 rounded-xl bg-[#09090C] border border-white/5 space-y-1">
                                    <div class="flex justify-between items-start">
                                        <span class="font-bold text-white"><strong class="text-[#FF9900]">{{ $it->quantity }}x</strong> {{ $it->product->name }}</span>
                                    </div>
                                    <div class="text-[11px] text-gray-400 space-x-2">
                                        <span>Gula: <strong class="text-gray-300">{{ $it->sugar_level }}</strong></span>
                                        <span>•</span>
                                        <span>Es: <strong class="text-gray-300">{{ $it->ice_level }}</strong></span>
                                        @if($it->extra_shots > 0)
                                            <span class="text-[#FF2E63] font-bold">• +{{ $it->extra_shots }} Shot</span>
                                        @endif
                                        @if($it->spicy_level > 0)
                                            <span class="text-red-400 font-bold">• Pedas Lv.{{ $it->spicy_level }}</span>
                                        @endif
                                    </div>
                                    @if($it->notes)
                                        <div class="text-[10px] text-[#FFDE59] italic">"{{ $it->notes }}"</div>
                                    @endif
                                </div>
                            @endforeach

                            @if($order->notes)
                                <div class="text-[11px] text-[#FF9900] bg-[#FF9900]/10 p-2 rounded-lg border border-[#FF9900]/20">
                                    <strong>Catatan Umum:</strong> "{{ $order->notes }}"
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Barista Action Buttons -->
                    <div class="pt-3 border-t border-white/10">
                        <form action="{{ route('kasir.queue.status', $order) }}" method="POST" class="grid grid-cols-2 gap-2">
                            @csrf
                            @method('PATCH')

                            @if($order->status === 'pending')
                                <button type="submit" name="status" value="brewing" class="col-span-2 bg-gradient-to-r from-[#FF2E63] to-[#FF9900] text-white font-extrabold text-xs py-2.5 rounded-xl shadow">
                                    ☕ Mulai Seduh
                                </button>
                            @elseif($order->status === 'brewing')
                                <button type="submit" name="status" value="ready" class="bg-cyan-500 hover:bg-cyan-600 text-white font-extrabold text-xs py-2.5 rounded-xl shadow">
                                    🔔 Siap di Counter
                                </button>
                                <button type="submit" name="status" value="completed" class="bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs py-2.5 rounded-xl shadow">
                                    ✅ Selesai
                                </button>
                            @elseif($order->status === 'ready')
                                <button type="submit" name="status" value="completed" class="col-span-2 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs py-2.5 rounded-xl shadow">
                                    ✅ Selesai (Serahkan ke Pelanggan)
                                </button>
                            @endif
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
