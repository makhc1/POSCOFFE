<!-- Quick Product Customization Modal -->
<div id="quick-modal-backdrop" class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-300">
    
    <div id="quick-modal-card" class="bg-[#16161C] border border-white/10 rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl relative animate-fade-in flex flex-col max-h-[90vh]">
        
        <!-- Modal Header Close Button -->
        <button onclick="window.closeQuickModal()" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-black/60 hover:bg-[#FF2E63] text-white flex items-center justify-center transition-colors">
            <i class="ph ph-xmark"></i>
        </button>

        <!-- Product Image Banner -->
        <div class="relative h-56 w-full bg-[#121216] shrink-0">
            <img id="modal-product-img" src="" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#16161C] via-transparent to-transparent"></div>
            <div class="absolute bottom-3 left-5 right-5 flex justify-between items-end">
                <div>
                    <span id="modal-product-category" class="text-[11px] font-extrabold uppercase tracking-wider text-[#FF9900] bg-[#FF9900]/10 px-2.5 py-1 rounded-lg border border-[#FF9900]/20"></span>
                    <h3 id="modal-product-name" class="font-display font-black text-xl text-white mt-1.5 line-clamp-1"></h3>
                </div>
                <div class="text-right">
                    <span id="modal-product-price" class="text-xl font-extrabold text-[#FF2E63]"></span>
                </div>
            </div>
        </div>

        <!-- Options Form (Scrollable) -->
        <form id="modal-custom-form" onsubmit="window.submitModalCart(event)" class="p-6 overflow-y-auto space-y-5 text-xs text-gray-300">
            <input type="hidden" id="modal-product-id" name="product_id">

            <p id="modal-product-desc" class="text-gray-400 text-xs leading-relaxed"></p>

            <!-- Level Badge Indicator (Kafein / Pedas) -->
            <div id="modal-level-indicator" class="p-3 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span id="modal-level-icon" class="text-lg text-[#FF2E63]">🔥</span>
                    <div>
                        <span class="font-bold text-white block">Level Racikan:</span>
                        <span id="modal-level-text" class="text-gray-400 text-[11px]"></span>
                    </div>
                </div>
                <span id="modal-level-tag" class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#FF2E63]/20 text-[#FF2E63] border border-[#FF2E63]/30"></span>
            </div>

            <!-- Custom Option: Sugar Level (For Drinks) -->
            <div id="modal-sugar-group" class="space-y-2">
                <label class="font-bold text-white uppercase tracking-wider flex items-center gap-1.5">
                    <i class="ph ph-cube text-[#FF9900]"></i> Level Gula (Sweetness)
                </label>
                <div class="grid grid-cols-4 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="sugar_level" value="Normal (100%)" checked class="peer sr-only">
                        <div class="text-center py-2 px-1 rounded-xl bg-[#0D0D11] border border-white/10 peer-checked:border-[#FF2E63] peer-checked:bg-[#FF2E63]/10 peer-checked:text-white font-bold transition-all">
                            Normal 100%
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="sugar_level" value="Less Sugar (50%)" class="peer sr-only">
                        <div class="text-center py-2 px-1 rounded-xl bg-[#0D0D11] border border-white/10 peer-checked:border-[#FF2E63] peer-checked:bg-[#FF2E63]/10 peer-checked:text-white font-bold transition-all">
                            Less 50%
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="sugar_level" value="No Sugar (0%)" class="peer sr-only">
                        <div class="text-center py-2 px-1 rounded-xl bg-[#0D0D11] border border-white/10 peer-checked:border-[#FF2E63] peer-checked:bg-[#FF2E63]/10 peer-checked:text-white font-bold transition-all">
                            No Sugar
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="sugar_level" value="Extra Sweet (120%)" class="peer sr-only">
                        <div class="text-center py-2 px-1 rounded-xl bg-[#0D0D11] border border-white/10 peer-checked:border-[#FF2E63] peer-checked:bg-[#FF2E63]/10 peer-checked:text-white font-bold transition-all">
                            Extra 120%
                        </div>
                    </label>
                </div>
            </div>

            <!-- Custom Option: Ice Level -->
            <div id="modal-ice-group" class="space-y-2">
                <label class="font-bold text-white uppercase tracking-wider flex items-center gap-1.5">
                    <i class="ph ph-snowflake text-cyan-400"></i> Level Es Batu
                </label>
                <div class="grid grid-cols-3 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="ice_level" value="Normal Ice" checked class="peer sr-only">
                        <div class="text-center py-2 rounded-xl bg-[#0D0D11] border border-white/10 peer-checked:border-cyan-400 peer-checked:bg-cyan-500/10 peer-checked:text-white font-bold transition-all">
                            Normal Ice
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="ice_level" value="Less Ice" class="peer sr-only">
                        <div class="text-center py-2 rounded-xl bg-[#0D0D11] border border-white/10 peer-checked:border-cyan-400 peer-checked:bg-cyan-500/10 peer-checked:text-white font-bold transition-all">
                            Less Ice
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="ice_level" value="No Ice" class="peer sr-only">
                        <div class="text-center py-2 rounded-xl bg-[#0D0D11] border border-white/10 peer-checked:border-cyan-400 peer-checked:bg-cyan-500/10 peer-checked:text-white font-bold transition-all">
                            No Ice
                        </div>
                    </label>
                </div>
            </div>

            <!-- Custom Option: Extra Espresso Shot -->
            <div id="modal-shot-group" class="space-y-2">
                <div class="flex justify-between items-center">
                    <label class="font-bold text-white uppercase tracking-wider flex items-center gap-1.5">
                        <i class="ph ph-mug-hot text-[#FF2E63]"></i> Tambahan Espresso Shot (+Rp 4.000/shot)
                    </label>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" onclick="window.changeShot(-1)" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 hover:bg-[#FF2E63] text-white font-bold">-</button>
                    <span id="modal-shot-count" class="font-bold text-sm text-white w-12 text-center">0 Shot</span>
                    <input type="hidden" id="modal-extra-shot-input" name="extra_shots" value="0">
                    <button type="button" onclick="window.changeShot(1)" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 hover:bg-[#FF2E63] text-white font-bold">+</button>
                </div>
            </div>

            <!-- Notes -->
            <div class="space-y-2">
                <label class="font-bold text-white uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-regular fa-comment-dots text-gray-400"></i> Catatan Khusus untuk Barista/Kitchen
                </label>
                <input type="text" name="notes" id="modal-notes-input" placeholder="Contoh: Pisah es batu / sambal jangan terlalu banyak" class="w-full bg-[#0D0D11] border border-white/10 focus:border-[#FF2E63] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none">
            </div>

            <!-- Quantity & Submit Button -->
            <div class="pt-4 border-t border-white/10 flex items-center gap-4">
                <div class="flex items-center bg-[#0D0D11] border border-white/10 rounded-xl p-1 shrink-0">
                    <button type="button" onclick="window.changeModalQty(-1)" class="w-8 h-8 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 font-bold">-</button>
                    <span id="modal-qty-display" class="w-8 text-center font-bold text-white">1</span>
                    <input type="hidden" id="modal-qty-input" name="quantity" value="1">
                    <button type="button" onclick="window.changeModalQty(1)" class="w-8 h-8 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 font-bold">+</button>
                </div>

                <button type="submit" class="flex-grow flex items-center justify-center gap-2 bg-gradient-to-r from-[#FF2E63] to-[#FF9900] hover:from-[#e01e53] hover:to-[#e68a00] text-white font-extrabold text-sm py-3 rounded-xl shadow-lg shadow-[#FF2E63]/30 transition-all">
                    <i class="ph ph-basket-shopping"></i>
                    <span>Tambah ke Keranjang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentExtraShot = 0;
    let currentModalQty = 1;

    window.openQuickModal = async function(productId) {
        try {
            const res = await fetch(`/api/product/${productId}`);
            const p = await res.json();

            document.getElementById('modal-product-id').value = p.id;
            document.getElementById('modal-product-name').innerText = p.name;
            document.getElementById('modal-product-category').innerText = p.category_name;
            document.getElementById('modal-product-desc').innerText = p.description || '';
            document.getElementById('modal-product-price').innerText = p.formatted_price;
            document.getElementById('modal-product-img').src = p.image_url;
            document.getElementById('modal-level-text').innerText = p.level_name;
            document.getElementById('modal-level-tag').innerText = p.badge || 'FAVORIT';

            // Show/hide drink options based on serving type
            const isDrink = p.serving_type !== 'food';
            document.getElementById('modal-sugar-group').style.display = isDrink ? 'block' : 'none';
            document.getElementById('modal-ice-group').style.display = isDrink ? 'block' : 'none';
            document.getElementById('modal-shot-group').style.display = isDrink ? 'block' : 'none';

            // Reset options
            currentExtraShot = 0;
            currentModalQty = 1;
            document.getElementById('modal-shot-count').innerText = '0 Shot';
            document.getElementById('modal-extra-shot-input').value = '0';
            document.getElementById('modal-qty-display').innerText = '1';
            document.getElementById('modal-qty-input').value = '1';
            document.getElementById('modal-notes-input').value = '';

            document.getElementById('quick-modal-backdrop').classList.remove('hidden');
        } catch (e) {
            console.error(e);
        }
    };

    window.closeQuickModal = function() {
        document.getElementById('quick-modal-backdrop').classList.add('hidden');
    };

    window.changeShot = function(delta) {
        currentExtraShot = Math.max(0, Math.min(5, currentExtraShot + delta));
        document.getElementById('modal-shot-count').innerText = `${currentExtraShot} Shot`;
        document.getElementById('modal-extra-shot-input').value = currentExtraShot;
    };

    window.changeModalQty = function(delta) {
        currentModalQty = Math.max(1, Math.min(50, currentModalQty + delta));
        document.getElementById('modal-qty-display').innerText = currentModalQty;
        document.getElementById('modal-qty-input').value = currentModalQty;
    };

    window.submitModalCart = async function(e) {
        e.preventDefault();
        const form = document.getElementById('modal-custom-form');
        const formData = new FormData(form);

        const payload = {
            product_id: formData.get('product_id'),
            quantity: formData.get('quantity'),
            sugar_level: formData.get('sugar_level'),
            ice_level: formData.get('ice_level'),
            extra_shots: formData.get('extra_shots'),
            notes: formData.get('notes'),
        };

        try {
            const res = await fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify(payload)
            });
            const data = await res.json();
            if(data.success) {
                window.closeQuickModal();
                window.showToast(data.message);
                window.loadCartData();
                window.openCartDrawer();
            }
        } catch(err) {
            console.error(err);
        }
    };
</script>
