@extends('layouts.app')

@section('title', 'Checkout Pesanan - Kopi Gacoan')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1200px] mx-auto min-h-[100dvh]">
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-16 text-center">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
            Finalisasi Pesanan
        </div>
        <h1 class="font-display font-medium text-4xl md:text-6xl text-white tracking-tight">
            Terminal <span class="italic text-[#FF2E63]">Checkout</span>.
        </h1>
    </div>

    @if(empty($cart))
        <div class="text-center py-32 bg-white/5 rounded-[2rem] border border-white/10 reveal-on-scroll">
            <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6">
                <i class="ph ph-shopping-cart text-2xl text-white/30"></i>
            </div>
            <h3 class="font-display font-medium text-2xl text-white mb-2">Keranjang Kosong</h3>
            <p class="text-sm text-white/40 mb-6">Pilih menu favoritmu terlebih dahulu.</p>
            <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center bg-white text-black font-semibold rounded-full px-6 py-3 text-sm active:scale-[0.98] awwwards-transition">
                Kembali ke Menu
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 relative items-start">
            
            <!-- Formulir Pemesanan (Left) -->
            <div class="lg:col-span-7 space-y-6 reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 delay-100">
                <div class="p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-xl">
                    <div class="bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] p-8">
                        <h2 class="font-display font-medium text-2xl text-white mb-6">Informasi Pemesan</h2>
                        
                        <form action="{{ route('order.place') }}" method="POST" id="checkout-form" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Nama Pemesan</label>
                                    <input type="text" name="customer_name" required value="{{ Auth::check() ? Auth::user()->name : '' }}" class="w-full bg-[#050505] border border-white/10 focus:border-white/30 rounded-xl px-4 py-3.5 text-sm text-white outline-none">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">No. WhatsApp</label>
                                    <input type="text" name="customer_phone" required class="w-full bg-[#050505] border border-white/10 focus:border-white/30 rounded-xl px-4 py-3.5 text-sm text-white outline-none" placeholder="08...">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Tipe Pesanan</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="order_type" value="dine_in" checked class="peer sr-only">
                                        <div class="w-full bg-[#050505] border border-white/10 peer-checked:border-[#FF2E63] rounded-xl px-4 py-4 text-center awwwards-transition group">
                                            <i class="ph ph-storefront text-2xl text-white/50 group-peer-checked:text-[#FF2E63] mb-2 awwwards-transition block mx-auto"></i>
                                            <span class="text-[11px] font-bold text-white uppercase tracking-widest">Dine-In</span>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="order_type" value="takeaway" class="peer sr-only">
                                        <div class="w-full bg-[#050505] border border-white/10 peer-checked:border-[#FF2E63] rounded-xl px-4 py-4 text-center awwwards-transition group">
                                            <i class="ph ph-bag text-2xl text-white/50 group-peer-checked:text-[#FF2E63] mb-2 awwwards-transition block mx-auto"></i>
                                            <span class="text-[11px] font-bold text-white uppercase tracking-widest">Takeaway</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="pt-4 text-right">
                                <button type="submit" class="group relative inline-flex items-center gap-3 bg-white text-[#050505] font-semibold rounded-full pl-6 pr-2 py-2 text-sm active:scale-[0.98] awwwards-transition">
                                    <span>Konfirmasi Pesanan</span>
                                    <div class="w-8 h-8 rounded-full bg-[#050505]/10 flex items-center justify-center group-hover:translate-x-1 awwwards-transition">
                                        <i class="ph ph-check text-sm"></i>
                                    </div>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Ringkasan (Right Sticky) -->
            <div class="lg:col-span-5 reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 delay-200">
                <div class="sticky top-32 p-1.5 bg-[#FF2E63]/10 rounded-[2rem] border border-[#FF2E63]/20 shadow-[0_20px_50px_rgba(255,46,99,0.1)]">
                    <div class="bg-[#050505] rounded-[calc(2rem-0.375rem)] p-8">
                        <h3 class="font-display font-medium text-2xl text-white mb-6">Ringkasan</h3>
                        
                        <div class="space-y-4 mb-8">
                            @foreach($cart as $item)
                                <div class="flex justify-between items-start gap-4 pb-4 border-b border-white/5">
                                    <div>
                                        <span class="block text-sm font-medium text-white">{{ $item['name'] }}</span>
                                        <span class="block text-[10px] text-white/50 mt-1">{{ $item['quantity'] }}x</span>
                                    </div>
                                    <span class="text-sm font-semibold text-white">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-4 border-t border-white/10 flex justify-between items-center">
                            <span class="text-[11px] font-bold uppercase tracking-widest text-white/50">Total Akhir</span>
                            <span class="font-display font-medium text-3xl text-[#FF2E63]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const el = document.querySelectorAll('.reveal-on-scroll');
            el.forEach(e => {
                e.classList.remove('translate-y-16', 'opacity-0', 'blur-md');
                e.classList.add('translate-y-0', 'opacity-100', 'blur-0');
            });
        }, 100);
    });
</script>
@endpush
@endsection
