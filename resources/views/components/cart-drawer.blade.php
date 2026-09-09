<!-- Cart Drawer Backdrop -->
<div id="cart-drawer-backdrop" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-sm transition-opacity" onclick="window.closeCartDrawer()"></div>

<!-- Slide-in Cart Drawer Panel -->
<div id="cart-drawer" class="fixed top-0 right-0 z-50 h-full w-full max-w-md bg-[#121216] border-l border-white/10 shadow-2xl flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out">
    
    <!-- Drawer Header -->
    <div class="p-5 border-b border-white/10 flex items-center justify-between bg-[#16161C]">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#FF2E63]/20 flex items-center justify-center text-[#FF2E63]">
                <i class="ph ph-basket-shopping text-lg"></i>
            </div>
            <div>
                <h3 class="font-display font-bold text-lg text-white">Keranjang Saya</h3>
                <p class="text-xs text-gray-400"><span class="cart-badge-count">0</span> Menu Siap Diseduh</p>
            </div>
        </div>
        <button onclick="window.closeCartDrawer()" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white flex items-center justify-center transition-colors">
            <i class="ph ph-xmark"></i>
        </button>
    </div>

    <!-- Cart Items Scrollable List -->
    <div class="flex-grow overflow-y-auto p-5 space-y-4">
        
        <!-- Empty State -->
        <div id="cart-empty-state" class="hidden text-center py-16 px-4">
            <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4 text-gray-600">
                <i class="ph ph-mug-saucer text-3xl"></i>
            </div>
            <h4 class="font-bold text-white text-base">Keranjangmu Masih Kosong</h4>
            <p class="text-xs text-gray-400 mt-1.5 max-w-xs mx-auto">Yuk pilih kopi jagoan atau dimsum favoritmu biar harimu makin nendang!</p>
            <a href="{{ route('menu.index') }}" onclick="window.closeCartDrawer()" class="inline-block mt-5 px-6 py-2.5 bg-gradient-to-r from-[#FF2E63] to-[#FF9900] text-white text-xs font-bold rounded-xl shadow-lg shadow-[#FF2E63]/30">
                Pilih Menu Sekarang
            </a>
        </div>

        <!-- Rendered Cart Items -->
        <div id="cart-items-container" class="space-y-3">
            <!-- Dynamic JS items inserted here -->
        </div>
    </div>

    <!-- Voucher & Summary Footer -->
    <div id="cart-footer-section" class="p-5 border-t border-white/10 bg-[#16161C] space-y-4">
        
        <!-- Voucher Input -->
        <div class="flex gap-2">
            <div class="relative flex-grow">
                <i class="ph ph-ticket absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                <input type="text" id="cart-voucher-input" placeholder="Punya kode promo? (GACOANHEMAT)" class="w-full bg-[#0D0D11] border border-white/10 focus:border-[#FF2E63] rounded-xl pl-9 pr-3 py-2 text-xs text-white uppercase placeholder:normal-case placeholder:text-gray-500 focus:outline-none">
            </div>
            <button onclick="window.applyCartVoucher()" class="bg-[#FF2E63] hover:bg-[#e01e53] text-white text-xs font-bold px-4 py-2 rounded-xl transition-colors shrink-0">
                Terapkan
            </button>
        </div>

        <!-- Summary Totals -->
        <div class="space-y-1.5 text-xs text-gray-300">
            <div class="flex justify-between">
                <span>Subtotal Pesanan</span>
                <span id="cart-subtotal-text" class="font-bold text-white">Rp 0</span>
            </div>
            <div id="cart-discount-row" class="hidden flex justify-between text-emerald-400 font-bold">
                <span>Diskon Promo</span>
                <span id="cart-discount-text">-Rp 0</span>
            </div>
            <div class="flex justify-between text-gray-400">
                <span>Pajak Restoran (PB1 10%)</span>
                <span id="cart-tax-text">Rp 0</span>
            </div>
            <div class="border-t border-white/10 pt-2 flex justify-between items-center text-sm font-extrabold text-white">
                <span>Total Pembayaran</span>
                <span id="cart-total-text" class="text-[#FF2E63] text-base">Rp 0</span>
            </div>
        </div>

        <!-- Checkout Buttons -->
        <div class="grid grid-cols-2 gap-3 pt-1">
            <a href="{{ route('order.checkout') }}" class="col-span-2 flex items-center justify-center gap-2 bg-gradient-to-r from-[#FF2E63] to-[#FF9900] hover:from-[#e01e53] hover:to-[#e68a00] text-white font-extrabold text-sm py-3.5 rounded-xl shadow-lg shadow-[#FF2E63]/30 transition-all text-center">
                <span>Lanjut ke Checkout</span>
                <i class="ph ph-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<script>
    window.applyCartVoucher = async function() {
        const code = document.getElementById('cart-voucher-input').value.trim();
        if(!code) return;
        
        try {
            const res = await fetch('{{ route("cart.apply-voucher") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ code: code })
            });
            const data = await res.json();
            if(data.success) {
                window.showToast(data.message);
                window.loadCartData();
            } else {
                alert(data.message);
            }
        } catch(e) {
            console.error(e);
        }
    }
</script>
