<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zafarwal Mandi - Fresh Farm Produce</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="antialiased">

    <!-- Navbar -->
    <nav class="navbar @yield('navbar-class')">
        <div class="container">
            <a href="/" class="nav-brand">
                <div class="icon">
                    <i data-lucide="leaf" style="width: 18px; color: white;"></i>
                </div>
                Zafarwal Mandi
            </a>
            
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Deals</a></li>
                <li><a href="#">Groceries</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            
            <div class="nav-actions">
                <a href="#"><i data-lucide="search" style="width: 20px;"></i></a>
                <a href="#"><i data-lucide="heart" style="width: 20px;"></i></a>
                <a href="#"><i data-lucide="shopping-cart" style="width: 20px;"></i></a>
                <a href="#" class="btn btn-primary">Join/Me</a>
            </div>
        </div>
    </nav>

    @yield("content")

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-col">
                    <div class="footer-brand">
                        <div class="icon">
                            <i data-lucide="leaf" style="width: 18px; color: white;"></i>
                        </div>
                        Zafarwal Mandi
                    </div>
                    <p class="footer-about">Your trusted online marketplace for fresh organic food, direct from the farms of Zafarwal Mandi.</p>
                    <div class="social-links">
                        <a href="#"><i data-lucide="facebook" style="width: 18px;"></i></a>
                        <a href="#"><i data-lucide="twitter" style="width: 18px;"></i></a>
                        <a href="#"><i data-lucide="instagram" style="width: 18px;"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4 class="footer-title">Contact Us</h4>
                    <ul class="footer-contact">
                        <li>
                            <i data-lucide="map-pin" style="width: 18px;"></i>
                            <span>Zafarwal Mandi, Main Market Road, Zafarwal City, Pakistan</span>
                        </li>
                        <li>
                            <i data-lucide="phone" style="width: 18px;"></i>
                            <span>+92 98765 43210</span>
                        </li>
                        <li>
                            <i data-lucide="mail" style="width: 18px;"></i>
                            <span>support@zafarwalmandi.com</span>
                        </li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4 class="footer-title">Newsletter</h4>
                    <p style="color: #aaaaaa; margin-bottom: 15px; font-size: 0.9rem;">Subscribe to get updates on fresh arrivals and exclusive offers.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2026 Zafarwal Mandi. All rights reserved.</p>
                <div style="display: flex; gap: 20px;">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Sticky Cart Popup -->
    @if(!Route::is('cart.index') && !Route::is('checkout.index'))
    <div id="sticky-cart" class="sticky-cart hidden">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
            <div class="cart-info">
                <div class="cart-icon-bg">
                    <i data-lucide="shopping-bag" style="color: var(--primary-green); width: 24px; height: 24px;"></i>
                    <span id="cart-count" class="cart-count">0</span>
                </div>
                <div class="cart-totals">
                    <span class="cart-items-text">My Cart &bull; <span id="cart-items-count">0</span> items</span>
                    <span class="cart-price-text">Total: Rs.<span id="cart-total-price">0</span></span>
                </div>
            </div>
            <a href="{{ route('cart.index') }}" class="btn btn-checkout" style="text-decoration:none;">
                Checkout <i data-lucide="arrow-right" style="width: 18px; margin-left: 5px;"></i>
            </a>
        </div>
    </div>
    @endif

    <!-- Initialize Icons -->
        <script>
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
            const isCartPage = window.location.pathname.includes('/cart');
            const isCheckoutPage = window.location.pathname.includes('/checkout');
            
            if (stickyCart && totalItems > 0 && !isCartPage && !isCheckoutPage) {
                if (stickyCart.classList.contains('hidden')) {
                    stickyCart.classList.remove('hidden');
                    setTimeout(() => stickyCart.classList.add('visible'), 10);
                }
            } else if (stickyCart && (totalItems === 0 || isCartPage || isCheckoutPage)) {
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
    </script>
</body>
</html>
