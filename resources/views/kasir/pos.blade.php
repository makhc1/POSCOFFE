@extends('layouts.kasir')

@section('title', 'Kasir POS - Bagelan Coffee')

@section('content')
<meta name="kasir-order-store-url" content="{{ route('kasir.order.store') }}">
<!-- The Editorial Split / Double-Bezel Architecture -->
<div class="flex-grow flex flex-col lg:flex-row h-full overflow-hidden bg-[#FAF7F2] border border-[#2D2420]/10 rounded-t-[2.5rem] p-1.5 shadow-[0_-20px_40px_rgba(45,36,32,0.05)]">
    
    <div class="w-full h-full bg-[#FDFBF7] rounded-[calc(2.5rem-0.375rem)] border border-[#2D2420]/5 shadow-[inset_0_1px_2px_rgba(255,255,255,1)] flex flex-col lg:flex-row overflow-hidden relative">

        <!-- LEFT: Menu Selection Catalog -->
        <div class="flex-grow flex flex-col p-6 overflow-hidden">
            
            <div class="flex items-center justify-between mb-6 shrink-0">
                <div>
                    <h2 class="font-editorial text-3xl text-[#2D2420]">Katalog Menu.</h2>
                    <p class="text-[10px] uppercase tracking-widest text-[#2D2420]/50 font-semibold mt-1">Pilih sajian untuk pelanggan</p>
                </div>
            </div>

            <!-- Search & Category Filters -->
            <div class="space-y-4 mb-6 shrink-0">
                <!-- Search Bar -->
                <div class="relative group">
                    <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-[#2D2420]/40 text-lg group-focus-within:text-[#2D2420] awwwards-transition"></i>
                    <input type="text" id="pos-search-input" onkeyup="window.filterPosMenu()"
                        placeholder="Cari kopi nusantara, kudapan, atau minuman lainnya..."
                        class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/30 rounded-2xl pl-12 pr-4 py-3.5 text-sm text-[#2D2420] placeholder:text-[#2D2420]/40 focus:outline-none focus:ring-0 awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]">
                </div>

                <!-- Category Filter Pills -->
                <div class="flex gap-2.5 overflow-x-auto pb-2 hide-scrollbar">
                    <button onclick="window.selectCategory('all')" id="cat-btn-all"
                        class="pos-cat-btn px-5 py-2.5 rounded-full text-[11px] uppercase tracking-widest font-bold shrink-0 bg-[#2D2420] text-[#FDFBF7] shadow-sm awwwards-transition">
                        Semua ({{ count($products) }})
                    </button>
                    @foreach($categories as $cat)
                    <button onclick="window.selectCategory('{{ $cat->slug }}')" id="cat-btn-{{ $cat->slug }}"
                        class="pos-cat-btn px-5 py-2.5 rounded-full text-[11px] uppercase tracking-widest font-bold shrink-0 bg-[#FAF7F2] text-[#2D2420]/60 hover:text-[#2D2420] border border-[#2D2420]/10 hover:border-[#2D2420]/30 awwwards-transition">
                        {{ $cat->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Scrollable Product Grid (Asymmetrical styling) -->
            <div class="flex-grow overflow-y-auto pr-2 hide-scrollbar pb-6">
                <div id="pos-products-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($products as $p)
                    <div data-category="{{ $p->category->slug }}" data-name="{{ strtolower($p->name) }}"
                        data-id="{{ $p->id }}" data-product-name="{{ $p->name }}" data-price="{{ (float) $p->price }}"
                        data-image="{{ asset($p->image_url) }}" data-serving="{{ $p->serving_type }}"
                        onclick="window.handleProductClick(this)"
                        class="pos-product-card bg-[#FAF7F2] border border-[#2D2420]/10 hover:border-[#2D2420]/40 hover:shadow-[0_10px_20px_rgba(45,36,32,0.08)] rounded-[1.5rem] p-3 cursor-pointer transition-all duration-500 flex flex-col justify-between group active:scale-[0.97]">
                        
                        <div>
                            <div class="relative h-32 w-full rounded-[1rem] overflow-hidden bg-[#2D2420]/5 mb-3 isolate">
                                <img src="{{ asset($p->image_url) }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] mix-blend-multiply opacity-90">
                                @if($p->badge)
                                <span class="absolute top-2 left-2 bg-[#FDFBF7]/90 backdrop-blur-sm text-[#2D2420] text-[9px] font-bold px-2 py-1 rounded-full shadow-sm uppercase tracking-wider border border-[#2D2420]/5 z-10">
                                    {{ $p->badge }}
                                </span>
                                @endif
                            </div>
                            <span class="text-[9px] font-bold text-[#2D2420]/40 uppercase tracking-widest block mb-1">{{ $p->category->name }}</span>
                            <h4 class="font-editorial font-bold text-sm text-[#2D2420] line-clamp-2 leading-tight">
                                {{ $p->name }}
                            </h4>
                        </div>
                        <div class="mt-3 pt-3 border-t border-[#2D2420]/10 flex justify-between items-center">
                            <span class="font-bold text-[#2D2420] text-sm">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                            <span class="w-8 h-8 rounded-full bg-[#FDFBF7] border border-[#2D2420]/10 group-hover:bg-[#2D2420] group-hover:border-[#2D2420] group-hover:text-[#FDFBF7] text-[#2D2420]/40 flex items-center justify-center text-sm transition-all duration-300">
                                <i class="ph ph-plus"></i>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- RIGHT: POS Register Billing Sidebar -->
        <div class="w-full lg:w-[420px] bg-[#FAF7F2] border-l border-[#2D2420]/10 flex flex-col h-full shrink-0 relative z-20">
            
            <!-- Register Header -->
            <div class="p-6 border-b border-[#2D2420]/10 flex items-center justify-between">
                <div>
                    <h3 class="font-editorial text-2xl text-[#2D2420]">Tiket Pesanan.</h3>
                    <p class="text-[9px] uppercase tracking-[0.2em] font-bold text-[#2D2420]/40 mt-1">Struk Real-time</p>
                </div>
                <button onclick="window.clearPosCart()" class="w-10 h-10 rounded-full border border-[#2D2420]/10 hover:bg-[#2D2420]/5 hover:text-[#2D2420] text-[#2D2420]/40 flex items-center justify-center awwwards-transition" title="Reset Keranjang">
                    <i class="ph ph-trash-can text-lg"></i>
                </button>
            </div>

            <!-- Customer & Order Options Form -->
            <div class="p-6 border-b border-[#2D2420]/10 space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div class="relative">
                        <input type="text" id="pos-customer-name" placeholder="Nama Pelanggan" value="Pelanggan Walk-in"
                            class="w-full bg-[#FDFBF7] border border-[#2D2420]/10 focus:border-[#2D2420]/30 rounded-xl px-4 py-2.5 text-xs text-[#2D2420] font-semibold focus:outline-none awwwards-transition placeholder:font-normal">
                    </div>
                    <div class="relative">
                        <input type="text" id="pos-table-number" placeholder="No. Meja"
                            class="w-full bg-[#FDFBF7] border border-[#2D2420]/10 focus:border-[#2D2420]/30 rounded-xl px-4 py-2.5 text-xs text-[#2D2420] font-semibold focus:outline-none awwwards-transition placeholder:font-normal">
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-2 p-1 bg-[#FDFBF7] border border-[#2D2420]/10 rounded-xl">
                    <button type="button" onclick="window.setPosOrderType('dine_in')" id="pos-type-dine_in"
                        class="pos-type-btn py-2 rounded-lg bg-[#2D2420] text-[#FDFBF7] font-bold text-[10px] uppercase tracking-wider text-center shadow-sm awwwards-transition">
                        Dine-in
                    </button>
                    <button type="button" onclick="window.setPosOrderType('takeaway')" id="pos-type-takeaway"
                        class="pos-type-btn py-2 rounded-lg bg-transparent text-[#2D2420]/50 hover:text-[#2D2420] font-bold text-[10px] uppercase tracking-wider text-center awwwards-transition">
                        Takeaway
                    </button>
                    <button type="button" onclick="window.setPosOrderType('delivery')" id="pos-type-delivery"
                        class="pos-type-btn py-2 rounded-lg bg-transparent text-[#2D2420]/50 hover:text-[#2D2420] font-bold text-[10px] uppercase tracking-wider text-center awwwards-transition">
                        Delivery
                    </button>
                </div>
                
                <div class="relative">
                    <select id="pos-outlet-select"
                        class="w-full bg-[#FDFBF7] border border-[#2D2420]/10 focus:border-[#2D2420]/30 rounded-xl px-4 py-2.5 text-xs text-[#2D2420] font-semibold focus:outline-none appearance-none">
                        @foreach($outlets as $o)
                        <option value="{{ $o->id }}">{{ $o->name }}</option>
                        @endforeach
                    </select>
                    <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-[#2D2420]/50"></i>
                </div>
            </div>

            <!-- Ordered Items Scroll List -->
            <div class="flex-grow overflow-y-auto p-6 space-y-3 hide-scrollbar relative bg-[url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%232d2420\' fill-opacity=\'0.02\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E')]">
                <div id="pos-empty-cart" class="absolute inset-0 flex flex-col items-center justify-center text-[#2D2420]/30">
                    <div class="w-16 h-16 rounded-full border border-[#2D2420]/10 flex items-center justify-center mb-4 bg-[#FDFBF7]">
                        <i class="ph ph-receipt text-2xl"></i>
                    </div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-center px-8">Struk Kosong.<br>Pilih menu di sebelah kiri.</p>
                </div>
                <div id="pos-items-list" class="space-y-3 relative z-10"></div>
            </div>

            <!-- Payment & Calculation Footer -->
            <div class="p-6 bg-[#FDFBF7] border-t border-[#2D2420]/10 shadow-[0_-10px_30px_rgba(45,36,32,0.02)] shrink-0 space-y-5 rounded-br-[calc(2.5rem-0.375rem)]">
                
                <!-- Price Summary -->
                <div class="space-y-2">
                    <div class="flex justify-between text-xs text-[#2D2420]/60 font-semibold">
                        <span>Subtotal:</span>
                        <span id="pos-subtotal-text" class="text-[#2D2420]">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-xs text-[#2D2420]/60 font-semibold">
                        <span>Pajak PB1 (10%):</span>
                        <span id="pos-tax-text">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-end pt-3 border-t border-[#2D2420]/10">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#2D2420]/50 mb-1">Total Tagihan</span>
                        <span id="pos-total-text" class="font-editorial text-3xl text-[#2D2420] leading-none">Rp 0</span>
                    </div>
                </div>

                <!-- Payment Method & Cash -->
                <div class="space-y-3 pt-4 border-t border-[#2D2420]/10">
                    <div class="grid grid-cols-2 gap-2 p-1 bg-[#FAF7F2] border border-[#2D2420]/10 rounded-xl">
                        <button type="button" onclick="window.setPosPayMethod('cash')" id="pay-btn-cash"
                            class="pos-pay-btn py-2.5 rounded-lg bg-[#2D2420] text-[#FDFBF7] font-bold text-[10px] uppercase tracking-wider text-center shadow-sm flex items-center justify-center gap-2 awwwards-transition">
                            <i class="ph ph-money text-sm"></i> Tunai
                        </button>
                        <button type="button" onclick="window.setPosPayMethod('qris')" id="pay-btn-qris"
                            class="pos-pay-btn py-2.5 rounded-lg bg-transparent text-[#2D2420]/50 hover:text-[#2D2420] font-bold text-[10px] uppercase tracking-wider text-center flex items-center justify-center gap-2 awwwards-transition">
                            <i class="ph ph-qr-code text-sm"></i> QRIS
                        </button>
                    </div>

                    <div id="cash-received-box" class="space-y-2">
                        <div class="relative group">
                            <i class="ph ph-wallet absolute left-4 top-1/2 -translate-y-1/2 text-[#2D2420]/40 group-focus-within:text-[#2D2420] awwwards-transition"></i>
                            <input type="number" id="pos-cash-input" onkeyup="window.calcChange()"
                                placeholder="Uang Diterima (Rp)"
                                class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/30 rounded-xl pl-10 pr-4 py-3 text-sm font-semibold text-[#2D2420] focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]">
                        </div>
                        <div class="bg-[#2D2420]/5 rounded-xl px-4 py-3 flex justify-between items-center border border-[#2D2420]/10">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-[#2D2420]/60">Kembalian</span>
                            <span id="pos-change-display" class="font-bold text-[#4E342E] text-sm">Rp 0</span>
                        </div>
                    </div>
                </div>

                <!-- Process Transaction Button (Button in Button Pattern) -->
                <button type="button" onclick="window.submitPosTransaction()"
                    class="w-full group/btn relative rounded-2xl bg-[#2D2420] hover:bg-[#4E342E] text-[#FDFBF7] pl-6 pr-2 py-2 flex items-center justify-between awwwards-transition shadow-[0_10px_20px_rgba(45,36,32,0.15)] active:scale-[0.98]">
                    <div class="flex flex-col items-start text-left">
                        <span class="text-[11px] font-bold uppercase tracking-widest leading-tight">Proses Pembayaran</span>
                        <span class="text-[9px] text-[#FDFBF7]/50 font-medium">Cetak Struk Transaksi</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-[#FDFBF7]/10 flex items-center justify-center group-hover/btn:scale-105 awwwards-transition">
                        <i class="ph ph-printer text-lg"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts and Modals stay functionally same, just restyled -->
<!-- Custom Duitku Payment Modal -->
<div id="duitku-custom-modal"
    class="hidden fixed inset-0 z-[60] bg-[#2D2420]/40 backdrop-blur-md flex items-center justify-center p-4">
    <div
        class="bg-[#FDFBF7] border border-[#2D2420]/10 rounded-[2rem] max-w-sm w-full p-8 shadow-[0_40px_80px_rgba(45,36,32,0.2)] space-y-6 text-center transform scale-100 transition-all">
        <h3 class="text-[#2D2420] font-editorial text-2xl">Pembayaran <span id="duitku-modal-method" class="text-[#8D6E63]"></span></h3>
        
        <div>
            <p class="text-[10px] uppercase tracking-widest font-semibold text-[#2D2420]/50 mb-1">Total Tagihan</p>
            <div id="duitku-modal-total" class="text-4xl font-editorial text-[#2D2420]"></div>
        </div>
        
        <div id="duitku-qr-container" class="hidden flex flex-col items-center justify-center p-6 bg-white rounded-2xl mx-auto w-fit border border-[#2D2420]/10 shadow-sm">
            <div id="duitku-qr-code"></div>
        </div>

        <div id="duitku-va-container" class="hidden space-y-3">
            <p class="text-[10px] uppercase tracking-widest font-semibold text-[#2D2420]/50">Nomor Virtual Account</p>
            <div class="bg-[#FAF7F2] border border-[#2D2420]/10 p-4 rounded-xl flex items-center justify-between">
                <span id="duitku-va-number" class="text-xl font-bold tracking-wider text-[#2D2420]"></span>
                <button type="button" onclick="copyVaNumber()" class="w-10 h-10 rounded-full bg-[#FDFBF7] border border-[#2D2420]/10 text-[#2D2420] hover:bg-[#2D2420] hover:text-[#FDFBF7] flex items-center justify-center awwwards-transition shadow-sm">
                    <i class="ph ph-copy text-lg"></i>
                </button>
            </div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-[#8D6E63]"><i class="ph ph-clock mr-1"></i> Menunggu pembayaran...</p>
        </div>
        
        <div id="duitku-redirect-container" class="hidden pt-4">
            <a id="duitku-redirect-btn" href="#" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-[#2D2420] hover:bg-[#4E342E] text-[#FDFBF7] font-bold py-3.5 rounded-xl text-[11px] uppercase tracking-widest awwwards-transition shadow-lg">
                Buka Halaman Pembayaran <i class="ph ph-arrow-up-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-3 pt-4 border-t border-[#2D2420]/10">
            <button onclick="checkPaymentStatus()" class="bg-[#FAF7F2] hover:bg-[#FDFBF7] text-[#2D2420] border border-[#2D2420]/10 font-bold py-3 rounded-xl text-[10px] uppercase tracking-widest awwwards-transition">
                Cek Status
            </button>
            <button onclick="closeDuitkuModal()" class="bg-[#FDFBF7] border border-[#FF2E63]/20 text-[#FF2E63] hover:bg-[#FF2E63]/5 font-bold py-3 rounded-xl text-[10px] uppercase tracking-widest awwwards-transition">
                Batal
            </button>
        </div>
    </div>
</div>

<!-- Modal Struk Transaksi Selesai -->
<div id="receipt-modal"
    class="hidden fixed inset-0 z-50 bg-[#2D2420]/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div
        class="bg-[#FDFBF7] border border-[#2D2420]/10 rounded-xl max-w-[320px] w-full p-6 shadow-2xl space-y-4 text-xs text-[#2D2420] relative">
        <div class="absolute -top-3 -left-3 w-6 h-6 bg-[#FAF7F2] rounded-full border-r border-b border-[#2D2420]/10"></div>
        <div class="absolute -top-3 -right-3 w-6 h-6 bg-[#FAF7F2] rounded-full border-l border-b border-[#2D2420]/10"></div>
        
        <div class="text-center space-y-1 pb-4 border-b border-dashed border-[#2D2420]/30">
            <span class="font-editorial font-bold text-xl text-[#2D2420]">Bagelan Coffee.</span>
            <p class="text-[9px] text-[#2D2420]/50 uppercase tracking-[0.2em] font-semibold">Tanda Terima Pembayaran</p>
            <span id="modal-receipt-order-no" class="font-mono font-bold text-[#2D2420] block mt-2 text-sm bg-[#FAF7F2] py-1 rounded"></span>
        </div>

        <div id="modal-receipt-items" class="space-y-2 max-h-48 overflow-y-auto hide-scrollbar font-mono text-[11px]"></div>

        <div class="pt-3 border-t border-dashed border-[#2D2420]/30 space-y-1.5 font-bold font-mono text-[11px]">
            <div class="flex justify-between"><span>Total:</span><span id="modal-receipt-total" class="text-sm"></span></div>
            <div class="flex justify-between text-[#2D2420]/60 font-medium"><span>Tunai:</span><span id="modal-receipt-cash"></span></div>
            <div class="flex justify-between text-[#2D2420]/60 font-medium"><span>Kembali:</span><span id="modal-receipt-change"></span></div>
        </div>

        <div class="pt-6 grid grid-cols-1 gap-2">
            <button onclick="window.printReceipt()" class="w-full bg-[#2D2420] hover:bg-[#4E342E] text-[#FDFBF7] font-bold py-3 rounded-xl flex items-center justify-center gap-2 text-[11px] uppercase tracking-widest awwwards-transition shadow-lg">
                <i class="ph ph-printer text-lg"></i> Cetak Struk
            </button>
            <button onclick="document.getElementById('receipt-modal').classList.add('hidden')" class="w-full bg-transparent hover:bg-[#FAF7F2] text-[#2D2420] font-bold py-3 rounded-xl text-[11px] uppercase tracking-widest awwwards-transition">
                Transaksi Baru
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    function showReceipt(data) {
        document.getElementById('modal-receipt-order-no').innerText = data.order_number;
        document.getElementById('modal-receipt-total').innerText = data.formatted_total;
        document.getElementById('modal-receipt-cash').innerText = data.payment_url ? 'Duitku Gateway' : 'Rp ' + new Intl.NumberFormat('id-ID').format(data.cash_received);
        document.getElementById('modal-receipt-change').innerText = data.payment_url ? '-' : data.formatted_change;

        let itemsHtml = '';
        posCart.forEach(it => {
            itemsHtml += `<div class="flex justify-between items-start">
                <span class="pr-2">${it.quantity}x ${it.name}</span>
                <span class="text-right whitespace-nowrap">Rp ${new Intl.NumberFormat('id-ID').format((it.unit_price + (it.extra_shots * 4000)) * it.quantity)}</span>
            </div>`;
        });
        document.getElementById('modal-receipt-items').innerHTML = itemsHtml;
        document.getElementById('receipt-modal').classList.remove('hidden');

        window.clearPosCart();
        document.getElementById('pos-cash-input').value = '';
    }

    let posCart = [];
    let currentOrderType = 'dine_in';
    let currentPayMethod = 'cash';

    window.handleProductClick = function (el) {
        const id = parseInt(el.dataset.id, 10);
        const name = el.dataset.productName;
        const price = parseFloat(el.dataset.price);
        const imageUrl = el.dataset.image;
        const servingType = el.dataset.serving;
        window.addToPosCart(id, name, price, imageUrl, servingType);
    };

    window.addToPosCart = function (id, name, price, imageUrl, servingType) {
        const existing = posCart.find(it => it.product_id === id && it.sugar_level === 'Normal (100%)' && it.extra_shots === 0);
        if (existing) {
            existing.quantity++;
        } else {
            posCart.push({
                product_id: id,
                name: name,
                unit_price: price,
                image_url: imageUrl,
                serving_type: servingType,
                quantity: 1,
                sugar_level: 'Normal (100%)',
                ice_level: 'Normal Ice',
                extra_shots: 0,
                spicy_level: 0,
                notes: ''
            });
        }
        window.renderPosCart();
    };

    window.renderPosCart = function () {
        const container = document.getElementById('pos-items-list');
        const emptyBox = document.getElementById('pos-empty-cart');

        if (posCart.length === 0) {
            emptyBox.classList.remove('hidden');
            container.innerHTML = '';
            document.getElementById('pos-subtotal-text').innerText = 'Rp 0';
            document.getElementById('pos-tax-text').innerText = 'Rp 0';
            document.getElementById('pos-total-text').innerText = 'Rp 0';
            return;
        }

        emptyBox.classList.add('hidden');
        let html = '';
        let subtotal = 0;

        posCart.forEach((item, index) => {
            const itemTotal = (item.unit_price + (item.extra_shots * 4000)) * item.quantity;
            subtotal += itemTotal;

            html += `
                <div class="p-3 bg-[#FDFBF7] rounded-xl border border-[#2D2420]/5 shadow-sm space-y-2 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#2D2420]/10 group-hover:bg-[#2D2420] transition-colors"></div>
                    <div class="flex justify-between items-start pl-2">
                        <span class="font-bold text-[#2D2420] text-xs line-clamp-2 pr-2">${item.name}</span>
                        <span class="font-bold text-[#2D2420] text-sm whitespace-nowrap">Rp ${new Intl.NumberFormat('id-ID').format(itemTotal)}</span>
                    </div>
                    <div class="flex justify-between items-center text-[9px] uppercase font-bold tracking-widest text-[#2D2420]/50 pl-2">
                        <span>${item.sugar_level} • ${item.ice_level} ${item.extra_shots > 0 ? '+' + item.extra_shots + 'S' : ''}</span>
                        <div class="flex items-center gap-2 bg-[#FAF7F2] p-1 rounded-lg border border-[#2D2420]/10">
                            <button onclick="window.changePosQty(${index}, -1)" class="w-5 h-5 rounded bg-[#FDFBF7] hover:bg-[#2D2420] hover:text-[#FDFBF7] text-[#2D2420] border border-[#2D2420]/5 flex items-center justify-center font-bold awwwards-transition"><i class="ph ph-minus"></i></button>
                            <span class="font-bold text-[#2D2420] text-[11px] w-3 text-center">${item.quantity}</span>
                            <button onclick="window.changePosQty(${index}, 1)" class="w-5 h-5 rounded bg-[#FDFBF7] hover:bg-[#2D2420] hover:text-[#FDFBF7] text-[#2D2420] border border-[#2D2420]/5 flex items-center justify-center font-bold awwwards-transition"><i class="ph ph-plus"></i></button>
                        </div>
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;

        const tax = Math.round(subtotal * 0.10);
        const total = subtotal + tax;

        document.getElementById('pos-subtotal-text').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
        document.getElementById('pos-tax-text').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(tax);
        document.getElementById('pos-total-text').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);

        window.calcChange();
    };

    window.changePosQty = function (index, delta) {
        posCart[index].quantity += delta;
        if (posCart[index].quantity <= 0) {
            posCart.splice(index, 1);
        }
        window.renderPosCart();
    };

    window.clearPosCart = function () {
        posCart = [];
        window.renderPosCart();
    };

    window.setPosOrderType = function (type) {
        currentOrderType = type;
        document.querySelectorAll('.pos-type-btn').forEach(btn => {
            btn.className = 'pos-type-btn py-2 rounded-lg bg-transparent text-[#2D2420]/50 hover:text-[#2D2420] font-bold text-[10px] uppercase tracking-wider text-center awwwards-transition';
        });
        document.getElementById(`pos-type-${type}`).className = 'pos-type-btn py-2 rounded-lg bg-[#2D2420] text-[#FDFBF7] font-bold text-[10px] uppercase tracking-wider text-center shadow-sm awwwards-transition';
    };

    window.setPosPayMethod = function (method) {
        currentPayMethod = method;
        document.querySelectorAll('.pos-pay-btn').forEach(btn => {
            btn.className = 'pos-pay-btn py-2.5 rounded-lg bg-transparent text-[#2D2420]/50 hover:text-[#2D2420] font-bold text-[10px] uppercase tracking-wider text-center flex items-center justify-center gap-2 awwwards-transition';
        });
        document.getElementById(`pay-btn-${method}`).className = 'pos-pay-btn py-2.5 rounded-lg bg-[#2D2420] text-[#FDFBF7] font-bold text-[10px] uppercase tracking-wider text-center shadow-sm flex items-center justify-center gap-2 awwwards-transition';

        const cashBox = document.getElementById('cash-received-box');
        if (method === 'cash') {
            cashBox.classList.remove('hidden');
        } else {
            cashBox.classList.add('hidden');
        }
    };

    window.calcChange = function () {
        let subtotal = posCart.reduce((sum, it) => sum + ((it.unit_price + (it.extra_shots * 4000)) * it.quantity), 0);
        let total = subtotal + Math.round(subtotal * 0.10);
        let cash = parseFloat(document.getElementById('pos-cash-input').value) || total;
        let change = Math.max(0, cash - total);
        document.getElementById('pos-change-display').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(change);
    };

    window.filterPosMenu = function () {
        const query = document.getElementById('pos-search-input').value.toLowerCase();
        document.querySelectorAll('.pos-product-card').forEach(card => {
            const name = card.getAttribute('data-name');
            if (name.includes(query)) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    };

    window.selectCategory = function (catSlug) {
        document.querySelectorAll('.pos-cat-btn').forEach(btn => {
            btn.className = 'pos-cat-btn px-5 py-2.5 rounded-full text-[11px] uppercase tracking-widest font-bold shrink-0 bg-[#FAF7F2] text-[#2D2420]/60 hover:text-[#2D2420] border border-[#2D2420]/10 hover:border-[#2D2420]/30 awwwards-transition';
        });
        document.getElementById(`cat-btn-${catSlug}`).className = 'pos-cat-btn px-5 py-2.5 rounded-full text-[11px] uppercase tracking-widest font-bold shrink-0 bg-[#2D2420] text-[#FDFBF7] shadow-sm awwwards-transition';

        document.querySelectorAll('.pos-product-card').forEach(card => {
            if (catSlug === 'all' || card.getAttribute('data-category') === catSlug) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    };

    window.submitPosTransaction = async function () {
        if (posCart.length === 0) {
            alert('Pilih minimal satu menu untuk transaksi!');
            return;
        }

        const customerName = document.getElementById('pos-customer-name').value.trim() || 'Pelanggan Walk-in';
        const tableNumber = document.getElementById('pos-table-number').value.trim();
        const outletId = document.getElementById('pos-outlet-select').value;
        const cashInput = parseFloat(document.getElementById('pos-cash-input').value) || null;

        const payload = {
            customer_name: customerName,
            order_type: currentOrderType,
            table_number: tableNumber,
            outlet_id: outletId,
            payment_method: currentPayMethod,
            cash_received: cashInput,
            items: posCart
        };

        try {
            const storeUrl = document.querySelector('meta[name="kasir-order-store-url"]').getAttribute('content');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const res = await fetch(storeUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();
            if (data.success) {
                if (data.qr_string || data.va_number || data.payment_url) {
                    document.getElementById('duitku-modal-method').innerText = data.payment_method.toUpperCase();
                    document.getElementById('duitku-modal-total').innerText = data.formatted_total;
                    
                    const qrContainer = document.getElementById('duitku-qr-container');
                    const vaContainer = document.getElementById('duitku-va-container');
                    const redirectContainer = document.getElementById('duitku-redirect-container');
                    
                    qrContainer.classList.add('hidden');
                    vaContainer.classList.add('hidden');
                    redirectContainer.classList.add('hidden');
                    document.getElementById('duitku-qr-code').innerHTML = ''; 

                    if (data.qr_string) {
                        qrContainer.classList.remove('hidden');
                        new QRCode(document.getElementById("duitku-qr-code"), {
                            text: data.qr_string,
                            width: 200,
                            height: 200,
                            colorDark : "#2D2420",
                            colorLight : "#ffffff",
                            correctLevel : QRCode.CorrectLevel.H
                        });
                    } else if (data.va_number) {
                        vaContainer.classList.remove('hidden');
                        document.getElementById('duitku-va-number').innerText = data.va_number;
                    } else if (data.payment_url) {
                        redirectContainer.classList.remove('hidden');
                        document.getElementById('duitku-redirect-btn').href = data.payment_url;
                    }
                    
                    document.getElementById('duitku-custom-modal').classList.remove('hidden');
                    window.currentPendingOrder = data;

                } else {
                    showReceipt(data);
                }
            } else {
                alert('Gagal memproses transaksi.');
            }
        } catch (e) {
            console.error(e);
            alert('Terjadi kesalahan koneksi.');
        }
    };
    
    window.copyVaNumber = function() {
        const va = document.getElementById('duitku-va-number').innerText;
        navigator.clipboard.writeText(va);
        alert('Nomor VA disalin: ' + va);
    };

    window.closeDuitkuModal = function() {
        document.getElementById('duitku-custom-modal').classList.add('hidden');
        if (window.currentPendingOrder) {
            showReceipt(window.currentPendingOrder);
            window.currentPendingOrder = null;
        }
    };

    window.checkPaymentStatus = function() {
        alert('Fitur cek status otomatis sedang berjalan di background.');
        closeDuitkuModal();
    };

    window.printReceipt = function () {
        window.print();
    };
</script>
@endpush
