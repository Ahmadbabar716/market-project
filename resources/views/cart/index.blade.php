@extends('layouts.frontend')
@section('navbar-class', 'solid-nav')

@section('content')
<div class="cart-page-wrap" style="background:var(--bg-light); padding: 80px 0; min-height: 80vh;">
    <div class="container">
        <h2 style="font-size:2rem; font-weight:700; margin-bottom: 30px;">Your Cart</h2>
        
        <div class="cart-layout">
            <div class="cart-items-section" id="cart-container">
                <!-- Injected via JS -->
            </div>
            
            <div class="cart-summary-section">
                <div class="summary-card">
                    <h3 class="summary-title">Order Summary</h3>
                    
                    <div class="summary-row">
                        <span id="summary-items-count">Items (0)</span>
                        <span id="summary-items-price">Rs.0.00</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Delivery Fee</span>
                        <span style="color:var(--primary-green); font-weight:600;">Free</span>
                    </div>
                    
                    <hr class="summary-divider">
                    
                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span id="summary-total-price" style="color:var(--primary-green);">Rs.0.00</span>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block" style="width:100%; margin-bottom:15px; padding: 15px; font-size:1.1rem; border-radius:10px; text-align:center; display:block; text-decoration:none;">
                        Proceed to Checkout <i data-lucide="arrow-right" style="width:18px; display:inline-block; vertical-align:middle; margin-left:5px;"></i>
                    </a>
                    
                    <a href="{{ route('products.index') }}" class="btn btn-outline btn-block" style="width:100%; padding: 15px; font-size:1rem; border-radius:10px; text-align:center; display:block;">
                        Continue Shopping
                    </a>
                </div>
                
                <div class="delivery-info">
                    <i data-lucide="map-pin" style="color:var(--primary-green); width:20px; flex-shrink:0;"></i>
                    <div>
                        <div style="font-weight:600; font-size:0.95rem;">Delivery Location</div>
                        <div style="color:var(--text-light); font-size:0.85rem;">Zafarwal City and nearby areas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* New Cart Layout CSS */
.cart-layout {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 30px;
    align-items: start;
}

@media (max-width: 900px) {
    .cart-layout {
        grid-template-columns: 1fr;
    }
}

.cart-item-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    margin-bottom: 20px;
    display: flex;
    gap: 25px;
    position: relative;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}

.cart-item-img {
    width: 100px;
    height: 100px;
    border-radius: 12px;
    background: var(--bg-light);
    object-fit: contain;
}

.cart-item-details {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.item-category {
    color: var(--primary-green);
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 3px;
}

.item-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.item-seller {
    color: var(--text-light);
    font-size: 0.85rem;
    margin-bottom: 20px;
}

.cart-qty-wrapper {
    display: inline-flex;
    align-items: center;
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 3px 12px;
    background: white;
    gap: 15px;
    width: fit-content;
}

.cart-item-price-wrapper {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-end;
}

.item-delete-btn {
    position: absolute;
    top: 25px;
    right: 25px;
    background: none;
    border: none;
    color: #ff6b6b;
    cursor: pointer;
    transition: transform 0.2s;
}

.item-delete-btn:hover {
    transform: scale(1.1);
}

.item-total-price {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.item-unit-price {
    color: var(--text-light);
    font-size: 0.9rem;
}

.summary-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    margin-bottom: 20px;
}

.summary-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 25px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    color: var(--text-light);
    font-size: 0.95rem;
}

.summary-divider {
    border: 0;
    height: 1px;
    background: var(--border-color);
    margin: 20px 0;
}

.summary-total {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 30px;
}

.delivery-info {
    background: white;
    border-radius: 16px;
    padding: 20px;
    border: 1px solid var(--border-color);
    display: flex;
    gap: 15px;
    align-items: center;
}

.empty-cart {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 16px;
    border: 1px solid var(--border-color);
}
</style>

<script>
    let pageCartItems = [];

    function renderCart() {
        const savedCart = localStorage.getItem('cart');
        const container = document.getElementById('cart-container');
        
        if (savedCart) {
            pageCartItems = JSON.parse(savedCart);
        }

        if (pageCartItems.length === 0) {
            container.innerHTML = `
                <div class="empty-cart">
                    <i data-lucide="shopping-bag" style="width:64px; height:64px; color:var(--text-light); margin: 0 auto 20px; opacity:0.5;"></i>
                    <h3 style="font-size:1.5rem; margin-bottom:10px;">Your cart is empty</h3>
                    <p style="color:var(--text-light); margin-bottom:25px;">Looks like you haven't added any fresh produce yet.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary" style="padding: 12px 30px;">Start Shopping</a>
                </div>
            `;
            updateSummary();
            lucide.createIcons();
            return;
        }

        let html = '';
        pageCartItems.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            const unitDisplay = (item.quantity % 1 === 0) ? item.quantity : item.quantity.toFixed(1);
            
            html += `
                <div class="cart-item-card" data-index="${index}">
                    <button class="item-delete-btn" onclick="removeItem(${index})"><i data-lucide="trash-2" style="width:20px;"></i></button>
                    
                    <img src="${item.image || 'https://images.unsplash.com/photo-1560806887-1e4cd0b6fac6?auto=format&fit=crop&w=400&q=80'}" class="cart-item-img" alt="${item.title}">
                    
                    <div class="cart-item-details">
                        <div class="item-category">${item.category || 'Fresh Produce'}</div>
                        <div class="item-title">${item.title}</div>
                        <div class="item-seller">Sold by ${item.seller || 'Zafarwal Mandi'}</div>
                        
                        <div class="cart-qty-wrapper">
                            <button type="button" class="qty-btn minus" style="background:none; border:none; cursor:pointer; font-size:1.2rem; color:var(--text-dark);" onclick="changeQty(${index}, -0.5)">−</button>
                            <span class="qty-display" style="font-weight:600; min-width:40px; text-align:center;">${unitDisplay} ${item.unit}</span>
                            <button type="button" class="qty-btn plus" style="background:none; border:none; cursor:pointer; font-size:1.2rem; color:var(--text-dark);" onclick="changeQty(${index}, 0.5)">+</button>
                        </div>
                    </div>

                    <div class="cart-item-price-wrapper">
                        <div class="item-total-price">Rs.${itemTotal.toFixed(2)}</div>
                        <div class="item-unit-price">Rs.${item.price.toFixed(2)}/${item.unit}</div>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
        updateSummary();
        lucide.createIcons();
    }

    function changeQty(index, change) {
        let item = pageCartItems[index];
        let newQty = item.quantity + change;
        if (newQty < 0.5) newQty = 0.5;
        if (newQty > 50) newQty = 50;
        
        item.quantity = newQty;
        saveAndRender();
    }

    function removeItem(index) {
        pageCartItems.splice(index, 1);
        saveAndRender();
    }

    function saveAndRender() {
        localStorage.setItem('cart', JSON.stringify(pageCartItems));
        renderCart();
        
        // Push the update back to the main layout navbar so counts sync up
        if (typeof updateCartUI === 'function') {
            cartItems = pageCartItems;
            updateCartUI();
        }
    }

    function updateSummary() {
        let totalItems = pageCartItems.length;
        let totalPrice = pageCartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        
        document.getElementById('summary-items-count').textContent = `Items (${totalItems})`;
        document.getElementById('summary-items-price').textContent = `Rs.${totalPrice.toFixed(2)}`;
        document.getElementById('summary-total-price').textContent = `Rs.${totalPrice.toFixed(2)}`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        // slight delay to ensure lucide script is fully parsed
        setTimeout(renderCart, 50);
    });
</script>
@endsection
