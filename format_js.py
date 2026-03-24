import sys
import re

def process():
    file_path = r'd:\market\resources\views\layouts\frontend.blade.php'
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    new_script = """    <script>
        let cartItems = [];

        function loadCart() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                cartItems = JSON.parse(savedCart);
                updateCartUI();
            }
        }

        function updateCartUI() {
            let totalItems = cartItems.length;
            let totalPrice = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            let cartCountEl = document.getElementById('cart-count');
            let cartItemsCountEl = document.getElementById('cart-items-count');
            let cartTotalPriceEl = document.getElementById('cart-total-price');
            
            if (cartCountEl) cartCountEl.textContent = totalItems;
            if (cartItemsCountEl) cartItemsCountEl.textContent = totalItems;
            if (cartTotalPriceEl) cartTotalPriceEl.textContent = totalPrice.toFixed(2);

            const stickyCart = document.getElementById('sticky-cart');
            if (stickyCart && totalItems > 0) {
                if (stickyCart.classList.contains('hidden')) {
                    stickyCart.classList.remove('hidden');
                    setTimeout(() => stickyCart.classList.add('visible'), 10);
                }
            } else if (stickyCart && totalItems === 0) {
                stickyCart.classList.remove('visible');
                setTimeout(() => stickyCart.classList.add('hidden'), 500);
            }
        }

        function addToCart(btn) {
            const card = btn.closest('.product-card');
            const qtyDisplay = card.querySelector('.qty-display');
            const title = card.querySelector('.product-title').innerText;
            const imgSrc = card.querySelector('.product-img') ? card.querySelector('.product-img').src : '';
            
            let quantity = 1;
            let unit = 'kg';
            if (qtyDisplay) {
                quantity = parseFloat(qtyDisplay.getAttribute('data-value')) || 1;
                let unitParts = qtyDisplay.textContent.trim().split(' ');
                unitParts.shift();
                unit = unitParts.join(' ') || 'kg';
            }

            const pricePerUnit = parseFloat(btn.getAttribute('data-price')) || 0;
            
            const existingItemIndex = cartItems.findIndex(item => item.title === title);
            if (existingItemIndex > -1) {
                cartItems[existingItemIndex].quantity += quantity;
            } else {
                cartItems.push({
                    title: title,
                    price: pricePerUnit,
                    quantity: quantity,
                    unit: unit,
                    image: imgSrc,
                    seller: 'Zafarwal Mandi',
                    category: 'Fresh Produce'
                });
            }

            localStorage.setItem('cart', JSON.stringify(cartItems));
            updateCartUI();

            const originalText = btn.innerHTML;
            btn.innerHTML = '<i data-lucide="check" style="width:16px; display:inline-block; vertical-align:middle; margin-right:6px;"></i> Added';
            btn.style.background = '#0b8a26';
            lucide.createIcons();
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = 'var(--primary-green)';
                lucide.createIcons();
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadCart();
            lucide.createIcons();
        });
    </script>"""

    # Replace everything between <script> and </script>
    updated_content = re.sub(r'<script>\s*let cartTotalItems.*?</script>', new_script, content, flags=re.DOTALL)

    # Change checkout button
    old_btn = '<button class="btn btn-checkout">'
    new_btn = '<a href="{{ route(\'cart.index\') }}" class="btn btn-checkout" style="text-decoration:none;">'
    updated_content = updated_content.replace(old_btn, new_btn)
    
    old_btn_close = '        </button>\n    </div>'
    new_btn_close = '        </a>\n    </div>'
    updated_content = updated_content.replace(old_btn_close, new_btn_close)


    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(updated_content)

if __name__ == '__main__':
    process()
