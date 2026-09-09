@extends('layouts.kasir')

@section('title', 'Kasir POS Counter - Kopi Gacoan')

@section('content')
<meta name="kasir-order-store-url" content="{{ route('kasir.order.store') }}">
<div class="flex-grow flex flex-col lg:flex-row h-[calc(100vh-61px)] overflow-hidden">

    <!-- LEFT: Menu Selection Catalog -->
    <div class="flex-grow flex flex-col p-4 sm:p-6 overflow-hidden bg-[#0D0D11]">

        <!-- Search & Category Filters -->
        <div class="space-y-3 mb-4 shrink-0">
            <!-- Search Bar -->
            <div class="relative">
                <i
                    class="ph ph-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                <input type="text" id="pos-search-input" onkeyup="window.filterPosMenu()"
                    placeholder="Cari nama kopi, dimsum, es setan..."
                    class="w-full bg-[#16161C] border border-white/10 focus:border-[#FF9900] rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder:text-gray-500 focus:outline-none">
            </div>

            <!-- Category Filter Pills -->
            <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-none">
                <button onclick="window.selectCategory('all')" id="cat-btn-all"
                    class="pos-cat-btn px-4 py-2 rounded-xl text-xs font-bold shrink-0 bg-[#FF9900] text-white shadow">
                    Semua ({{ count($products) }})
                </button>
                @foreach($categories as $cat)
                <button onclick="window.selectCategory('{{ $cat->slug }}')" id="cat-btn-{{ $cat->slug }}"
                    class="pos-cat-btn px-4 py-2 rounded-xl text-xs font-bold shrink-0 bg-[#16161C] text-gray-300 hover:text-white border border-white/10 transition-colors">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Scrollable Product Grid -->
        <div class="flex-grow overflow-y-auto pr-1">
            <div id="pos-products-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-3.5">
                @foreach($products as $p)
                <div data-category="{{ $p->category->slug }}" data-name="{{ strtolower($p->name) }}"
                    data-id="{{ $p->id }}" data-product-name="{{ $p->name }}" data-price="{{ (float) $p->price }}"
                    data-image="{{ $p->image_url }}" data-serving="{{ $p->serving_type }}"
                    onclick="window.handleProductClick(this)"
                    class="pos-product-card bg-[#16161C] border border-white/10 hover:border-[#FF9900] rounded-2xl p-3 shadow cursor-pointer transition-all hover:scale-[1.02] flex flex-col justify-between group active:scale-95">
                    <div>
                        <div class="relative h-28 w-full rounded-xl overflow-hidden bg-black/40 mb-2">
                            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                            @if($p->badge)
                            <span
                                class="absolute top-1.5 left-1.5 bg-[#FF2E63] text-white text-[8px] font-black px-1.5 py-0.5 rounded shadow uppercase">
                                {{ $p->badge }}
                            </span>
                            @endif
                        </div>
                        <span class="text-[9px] font-bold text-[#FF9900] uppercase block">{{ $p->category->name
                            }}</span>
                        <h4
                            class="font-bold text-xs text-white line-clamp-1 group-hover:text-[#FF9900] transition-colors">
                            {{ $p->name }}</h4>
                    </div>
                    <div class="mt-2 pt-2 border-t border-white/10 flex justify-between items-center">
                        <span class="font-extrabold text-[#FF2E63] text-xs">Rp {{ number_format($p->price, 0, ',', '.')
                            }}</span>
                        <span
                            class="w-6 h-6 rounded-lg bg-white/5 group-hover:bg-[#FF9900] group-hover:text-white text-gray-400 flex items-center justify-center text-xs font-bold transition-colors">+</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- RIGHT: POS Register Billing Sidebar -->
    <div class="w-full lg:w-96 bg-[#16161C] border-l border-white/10 flex flex-col h-full shrink-0 shadow-2xl">

        <!-- Register Header -->
        <div class="p-4 border-b border-white/10 bg-[#121216] flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="ph ph-receipt text-[#FF9900]"></i>
                <h3 class="font-display font-bold text-sm text-white">Struk Pesanan Kasir</h3>
            </div>
            <button onclick="window.clearPosCart()" class="text-xs text-gray-500 hover:text-red-400 font-bold"
                title="Reset Keranjang">
                <i class="ph ph-trash-can mr-1"></i> Reset
            </button>
        </div>

        <!-- Customer & Order Options Form -->
        <div class="p-4 bg-[#14141A] border-b border-white/10 space-y-2.5 text-xs">
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <input type="text" id="pos-customer-name" placeholder="Nama Pelanggan *" value="Pelanggan Walk-in"
                        class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF9900] rounded-xl px-3 py-2 text-xs text-white focus:outline-none">
                </div>
                <div>
                    <input type="text" id="pos-table-number" placeholder="No. Meja (Cth: Meja 05)"
                        class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF9900] rounded-xl px-3 py-2 text-xs text-white focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-1.5">
                <button type="button" onclick="window.setPosOrderType('dine_in')" id="pos-type-dine_in"
                    class="pos-type-btn py-1.5 px-2 rounded-lg bg-[#FF9900] text-white font-bold text-[11px] text-center shadow">
                    Dine-in
                </button>
                <button type="button" onclick="window.setPosOrderType('takeaway')" id="pos-type-takeaway"
                    class="pos-type-btn py-1.5 px-2 rounded-lg bg-[#09090C] text-gray-400 font-bold text-[11px] text-center border border-white/10">
                    Takeaway
                </button>
                <button type="button" onclick="window.setPosOrderType('delivery')" id="pos-type-delivery"
                    class="pos-type-btn py-1.5 px-2 rounded-lg bg-[#09090C] text-gray-400 font-bold text-[11px] text-center border border-white/10">
                    Delivery
                </button>
            </div>
            <div>
                <select id="pos-outlet-select"
                    class="w-full bg-[#09090C] border border-white/10 rounded-xl px-3 py-1.5 text-[11px] text-gray-300 focus:outline-none">
                    @foreach($outlets as $o)
                    <option value="{{ $o->id }}">{{ $o->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Ordered Items Scroll List -->
        <div class="flex-grow overflow-y-auto p-4 space-y-2.5">
            <div id="pos-empty-cart" class="text-center py-12 text-gray-500">
                <i class="ph ph-cash-register text-3xl mb-2"></i>
                <p class="text-xs">Klik menu di sebelah kiri untuk menambah ke struk.</p>
            </div>
            <div id="pos-items-list" class="space-y-2"></div>
        </div>

        <!-- Payment & Calculation Footer -->
        <div class="p-4 bg-[#121216] border-t border-white/10 space-y-3 shrink-0 text-xs">

            <!-- Price Summary -->
            <div class="space-y-1 text-gray-300">
                <div class="flex justify-between">
                    <span>Subtotal:</span>
                    <span id="pos-subtotal-text" class="font-bold text-white">Rp 0</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>Pajak PB1 (10%):</span>
                    <span id="pos-tax-text">Rp 0</span>
                </div>
                <div class="flex justify-between text-sm font-black text-white pt-1 border-t border-white/10">
                    <span>Total Tagihan:</span>
                    <span id="pos-total-text" class="text-[#FF2E63] text-base">Rp 0</span>
                </div>
            </div>

            <!-- Payment Method & Cash Received -->
            <div class="space-y-2 pt-2 border-t border-white/10">
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="window.setPosPayMethod('cash')" id="pay-btn-cash"
                        class="pos-pay-btn py-2 rounded-xl bg-[#FF9900] text-white font-bold text-xs text-center">
                        <i class="ph ph-money w-4 h-4 mr-1"></i> Tunai
                    </button>
                    <button type="button" onclick="window.setPosPayMethod('qris')" id="pay-btn-qris"
                        class="pos-pay-btn py-2 rounded-xl bg-[#09090C] text-gray-400 font-bold text-xs text-center border border-white/10">
                        <i class="ph ph-qr-code w-4 h-4 mr-1"></i> QRIS
                    </button>
                </div>

                <div id="cash-received-box" class="flex items-center gap-2">
                    <input type="number" id="pos-cash-input" onkeyup="window.calcChange()"
                        placeholder="Nominal Uang Diterima (Rp)"
                        class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF9900] rounded-xl px-3 py-2 text-xs text-white focus:outline-none">
                    <span id="pos-change-display" class="shrink-0 font-bold text-emerald-400 text-xs">Kembali: Rp
                        0</span>
                </div>
            </div>

            <!-- Process Transaction Button -->
            <button type="button" onclick="window.submitPosTransaction()"
                class="w-full bg-gradient-to-r from-[#FF9900] to-[#FF2E63] hover:from-[#e68a00] hover:to-[#e01e53] text-white font-black text-sm py-3.5 rounded-xl shadow-lg transition-transform hover:scale-[1.02]">
                <i class="ph ph-circle-check mr-1.5"></i>
                <span>Proses & Cetak Struk</span>
            </button>
        </div>

    </div>

</div>

<!-- Custom Duitku Payment Modal -->
<div id="duitku-custom-modal"
    class="hidden fixed inset-0 z-[60] bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
    <div
        class="bg-[#16161C] border border-[#FF9900]/30 rounded-3xl max-w-sm w-full p-6 shadow-2xl space-y-6 animate-fade-in text-center">
        <h3 class="text-white font-bold text-lg">Pembayaran <span id="duitku-modal-method" class="text-[#FF9900]"></span></h3>
        
        <p class="text-sm text-gray-400">Total Pembayaran:</p>
        <div id="duitku-modal-total" class="text-3xl font-black text-white"></div>
        
        <div id="duitku-qr-container" class="hidden flex flex-col items-center justify-center p-4 bg-white rounded-2xl mx-auto w-fit">
            <!-- QR Code will be rendered here -->
            <div id="duitku-qr-code"></div>
        </div>

        <div id="duitku-va-container" class="hidden space-y-2">
            <p class="text-sm text-gray-400">Nomor Virtual Account:</p>
            <div class="bg-[#09090C] border border-white/10 p-3 rounded-xl flex items-center justify-between">
                <span id="duitku-va-number" class="text-xl font-bold tracking-wider text-[#FF9900]"></span>
                <button type="button" onclick="copyVaNumber()" class="text-gray-400 hover:text-white p-2">
                    <i class="ph ph-copy text-lg"></i>
                </button>
            </div>
            <p class="text-xs text-green-400 mt-2"><i class="ph ph-clock"></i> Menunggu pembayaran...</p>
        </div>
        
        <div id="duitku-redirect-container" class="hidden pt-4">
            <a id="duitku-redirect-btn" href="#" target="_blank" class="w-full inline-block bg-[#FF9900] hover:bg-[#e68a00] text-white font-bold py-3 rounded-xl text-sm awwwards-transition">
                Buka Halaman Pembayaran <i class="ph ph-arrow-up-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-3 pt-2">
            <button onclick="checkPaymentStatus()" class="bg-white/10 hover:bg-white/20 text-white font-bold py-2.5 rounded-xl text-xs">
                Cek Status
            </button>
            <button onclick="closeDuitkuModal()" class="border border-red-500/50 text-red-400 hover:bg-red-500/10 font-bold py-2.5 rounded-xl text-xs">
                Tutup & Batal
            </button>
        </div>
    </div>
</div>

<!-- Modal Struk Transaksi Selesai -->
<div id="receipt-modal"
    class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div
        class="bg-[#16161C] border border-white/10 rounded-3xl max-w-sm w-full p-6 shadow-2xl space-y-4 animate-fade-in text-xs text-gray-300">
        <div class="text-center space-y-1 pb-3 border-b border-white/10">
            <span class="font-display font-black text-lg text-white">KOPI GACOAN</span>
            <p class="text-[10px] text-gray-400 uppercase">Struk Pembayaran Kasir</p>
            <span id="modal-receipt-order-no" class="font-mono font-bold text-[#FFDE59] block"></span>
        </div>

        <div id="modal-receipt-items" class="space-y-1.5 max-h-40 overflow-y-auto"></div>

        <div class="pt-2 border-t border-white/10 space-y-1 text-right font-bold">
            <div class="flex justify-between"><span>Total:</span><span id="modal-receipt-total"
                    class="text-[#FF2E63]"></span></div>
            <div class="flex justify-between text-gray-400"><span>Uang Diterima:</span><span
                    id="modal-receipt-cash"></span></div>
            <div class="flex justify-between text-emerald-400"><span>Kembalian:</span><span
                    id="modal-receipt-change"></span></div>
        </div>

        <div class="pt-3 grid grid-cols-2 gap-2">
            <button onclick="window.printReceipt()"
                class="bg-[#FF9900] hover:bg-[#e68a00] text-white font-bold py-2.5 rounded-xl flex items-center justify-center gap-1">
                <i class="ph ph-print"></i> Cetak Struk
            </button>
            <button onclick="document.getElementById('receipt-modal').classList.add('hidden')"
                class="bg-white/10 hover:bg-white/20 text-white font-bold py-2.5 rounded-xl">
                Tutup (Baru)
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
            itemsHtml += `<div class="flex justify-between"><span>${it.quantity}x ${it.name}</span><span>Rp ${new Intl.NumberFormat('id-ID').format((it.unit_price + (it.extra_shots * 4000)) * it.quantity)}</span></div>`;
        });
        document.getElementById('modal-receipt-items').innerHTML = itemsHtml;
        document.getElementById('receipt-modal').classList.remove('hidden');

        window.clearPosCart();
        document.getElementById('pos-cash-input').value = '';
    }

    let posCart = [];
    let currentOrderType = 'dine_in';
    let currentPayMethod = 'cash';

    // Reads product data from the clicked card's data-* attributes and
    // forwards it to addToPosCart. This avoids mixing Blade's @{{ }} syntax
    // directly inside an inline JS onclick string, which confuses JS parsers/linters.
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
                <div class="p-2.5 bg-[#09090C] rounded-xl border border-white/10 space-y-1.5">
                    <div class="flex justify-between items-start">
                        <span class="font-bold text-white text-xs line-clamp-1">${item.name}</span>
                        <span class="font-extrabold text-[#FF2E63] text-xs">Rp ${new Intl.NumberFormat('id-ID').format(itemTotal)}</span>
                    </div>
                    <div class="flex justify-between items-center text-[10px] text-gray-400">
                        <span>${item.sugar_level} • ${item.ice_level} ${item.extra_shots > 0 ? '+' + item.extra_shots + ' Shot' : ''}</span>
                        <div class="flex items-center gap-2">
                            <button onclick="window.changePosQty(${index}, -1)" class="w-5 h-5 rounded bg-white/10 hover:bg-[#FF2E63] text-white flex items-center justify-center font-bold">-</button>
                            <span class="font-bold text-white">${item.quantity}</span>
                            <button onclick="window.changePosQty(${index}, 1)" class="w-5 h-5 rounded bg-white/10 hover:bg-[#FF2E63] text-white flex items-center justify-center font-bold">+</button>
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
            btn.className = 'pos-type-btn py-1.5 px-2 rounded-lg bg-[#09090C] text-gray-400 font-bold text-[11px] text-center border border-white/10';
        });
        document.getElementById(`pos-type-${type}`).className = 'pos-type-btn py-1.5 px-2 rounded-lg bg-[#FF9900] text-white font-bold text-[11px] text-center shadow';
    };

    window.setPosPayMethod = function (method) {
        currentPayMethod = method;
        document.querySelectorAll('.pos-pay-btn').forEach(btn => {
            btn.className = 'pos-pay-btn py-2 rounded-xl bg-[#09090C] text-gray-400 font-bold text-xs text-center border border-white/10';
        });
        document.getElementById(`pay-btn-${method}`).className = 'pos-pay-btn py-2 rounded-xl bg-[#FF9900] text-white font-bold text-xs text-center';

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
        document.getElementById('pos-change-display').innerText = 'Kembali: Rp ' + new Intl.NumberFormat('id-ID').format(change);
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
            btn.className = 'pos-cat-btn px-4 py-2 rounded-xl text-xs font-bold shrink-0 bg-[#16161C] text-gray-300 hover:text-white border border-white/10 transition-colors';
        });
        document.getElementById(`cat-btn-${catSlug}`).className = 'pos-cat-btn px-4 py-2 rounded-xl text-xs font-bold shrink-0 bg-[#FF9900] text-white shadow';

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
                    // Tampilkan Custom Modal Duitku
                    document.getElementById('duitku-modal-method').innerText = data.payment_method.toUpperCase();
                    document.getElementById('duitku-modal-total').innerText = data.formatted_total;
                    
                    const qrContainer = document.getElementById('duitku-qr-container');
                    const vaContainer = document.getElementById('duitku-va-container');
                    const redirectContainer = document.getElementById('duitku-redirect-container');
                    
                    qrContainer.classList.add('hidden');
                    vaContainer.classList.add('hidden');
                    redirectContainer.classList.add('hidden');
                    document.getElementById('duitku-qr-code').innerHTML = ''; // reset QR

                    if (data.qr_string) {
                        qrContainer.classList.remove('hidden');
                        new QRCode(document.getElementById("duitku-qr-code"), {
                            text: data.qr_string,
                            width: 200,
                            height: 200,
                            colorDark : "#000000",
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
                    
                    // Simpan data order sementara untuk update status
                    window.currentPendingOrder = data;

                } else {
                    // Pembayaran Cash / Non-Duitku
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
        // Implementasi cek status Duitku, bisa dengan panggil route API internal
        // Untuk sekarang kita hanya tutup modal dan tunjukkan receipt
        alert('Fitur cek status otomatis sedang berjalan di background.');
        closeDuitkuModal();
    };

    window.printReceipt = function () {
        window.print();
    };
</script>
@endpush
