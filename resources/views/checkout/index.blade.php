@extends('layouts.frontend')
@section('navbar-class', 'solid-nav')

@section('content')
<div class="checkout-page-wrap" style="background:var(--bg-light); padding: 60px 0; min-height: 80vh;">
    <div class="container">
        <h2 style="font-size:2rem; font-weight:700; margin-bottom: 30px;">Checkout</h2>
        
        <div class="checkout-layout">
            <div class="checkout-form-section">
                <div class="form-card">
                    <h3 class="form-title">Delivery Information</h3>
                    <form id="checkout-form">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" placeholder="email@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">WhatsApp Number *</label>
                                <input type="tel" id="phone" name="phone" placeholder="+92 XXX XXX XXXX (WhatsApp)" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Delivery Address *</label>
                            <textarea id="address" name="address" rows="3" placeholder="Street address, apartment, suite, etc." required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="landmark">Specific Location / Landmark (Optional)</label>
                            <input type="text" id="landmark" name="landmark" placeholder="e.g. Near Main Market Mosque">
                        </div>
                        
                        <div class="payment-method">
                            <h4 style="margin-bottom:15px; font-weight:600;">Payment Method</h4>
                            <div class="payment-option selected">
                                <i data-lucide="hand-coins" style="width:20px; color:var(--primary-green);"></i>
                                <span>Cash on Delivery (COD)</span>
                                <i data-lucide="check-circle" style="width:18px; color:var(--primary-green); margin-left:auto;"></i>
                            </div>
                            <p style="font-size:0.85rem; color:var(--text-light); margin-top:10px;">More payment methods coming soon!</p>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="checkout-summary-section">
                <div class="summary-card">
                    <h3 class="summary-title">Order Summary</h3>
                    <div id="checkout-items-container">
                        <!-- Injected via JS -->
                    </div>
                    
                    <hr class="summary-divider">
                    
                    <div class="summary-row">
                        <span id="checkout-items-count">Subtotal (0 items)</span>
                        <span id="checkout-items-price">Rs.0.00</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Delivery Fee</span>
                        <span style="color:var(--primary-green); font-weight:600;">Free</span>
                    </div>
                    
                    <hr class="summary-divider">
                    
                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span id="checkout-total-price" style="color:var(--primary-green);">Rs.0.00</span>
                    </div>
                    
                    <button type="button" class="btn btn-primary btn-block" style="width:100%; margin-top:10px; padding: 15px; font-size:1.1rem; border-radius:10px;" onclick="placeOrder()">
                        Place Order <i data-lucide="package" style="width:18px; display:inline-block; vertical-align:middle; margin-left:5px;"></i>
                    </button>
                    
                    <p style="text-align:center; font-size:0.8rem; color:var(--text-light); margin-top:15px;">
                        By placing your order, you agree to our Terms and Conditions.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Success Overlay -->
<div id="order-success-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.98); z-index:9999; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding: 20px;">
    <div style="max-width:500px;">
        <div style="width:80px; height:80px; background:var(--primary-green); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; margin: 0 auto 25px;">
            <i data-lucide="check" style="width:40px; height:40px;"></i>
        </div>
        <h2 style="font-size:2.5rem; font-weight:800; color:var(--text-dark); margin-bottom:15px;">Order successful!</h2>
        <p style="font-size:1.1rem; color:var(--text-light); margin-bottom:35px; line-height:1.6;">
            Thank you for your order! We've received your request and will process it shortly. You will receive a confirmation message on WhatsApp soon.
        </p>
        <div style="display:flex; gap:15px; justify-content:center;">
            <a href="/" class="btn btn-primary" style="padding: 15px 35px; border-radius:12px; font-weight:600;">
                Continue Shopping
            </a>
        </div>
    </div>
</div>

<style>
.checkout-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 30px;
    align-items: start;
}

@media (max-width: 991px) {
    .checkout-layout {
        grid-template-columns: 1fr;
    }
}

.form-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}

.form-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-color);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 8px;
    color: var(--text-dark);
}

.form-group input, 
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    font-size: 0.95rem;
    transition: border-color 0.3s;
}

.form-group input:focus, 
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary-green);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 576px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.payment-method {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid var(--border-color);
}

.payment-option {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s;
}

.payment-option.selected {
    border-color: var(--primary-green);
    background-color: #f0fdf4;
}

.summary-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    position: sticky;
    top: 100px;
}

.summary-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.checkout-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 0.9rem;
}

.checkout-item-info {
    display: flex;
    flex-direction: column;
}

.checkout-item-name {
    font-weight: 600;
    color: var(--text-dark);
}

.checkout-item-qty {
    font-size: 0.8rem;
    color: var(--text-light);
}

.checkout-item-price {
    font-weight: 700;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    color: var(--text-light);
    font-size: 0.95rem;
}

.summary-divider {
    border: 0;
    height: 1px;
    background: var(--border-color);
    margin: 15px 0;
}

.summary-total {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 20px;
}
</style>

<script>
    let checkoutItems = [];

    function renderCheckoutSummary() {
        const savedCart = localStorage.getItem('cart');
        const container = document.getElementById('checkout-items-container');
        
        if (savedCart) {
            checkoutItems = JSON.parse(savedCart);
        }

        if (checkoutItems.length === 0) {
            window.location.href = "{{ route('cart.index') }}";
            return;
        }

        let html = '';
        let totalItems = 0;
        let totalPrice = 0;

        checkoutItems.forEach(item => {
            const itemTotal = item.price * item.quantity;
            totalPrice += itemTotal;
            totalItems += 1;
            
            const unitDisplay = (item.quantity % 1 === 0) ? item.quantity : item.quantity.toFixed(1);
            
            html += `
                <div class="checkout-item">
                    <div class="checkout-item-info">
                        <span class="checkout-item-name">${item.title}</span>
                        <span class="checkout-item-qty">${unitDisplay} ${item.unit} x Rs.${item.price.toFixed(2)}</span>
                    </div>
                    <span class="checkout-item-price">Rs.${itemTotal.toFixed(2)}</span>
                </div>
            `;
        });
        
        container.innerHTML = html;
        document.getElementById('checkout-items-count').textContent = `Subtotal (${totalItems} items)`;
        document.getElementById('checkout-items-price').textContent = `Rs.${totalPrice.toFixed(2)}`;
        document.getElementById('checkout-total-price').textContent = `Rs.${totalPrice.toFixed(2)}`;
    }

    async function placeOrder() {
        const form = document.getElementById('checkout-form');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const formData = new FormData(form);
        const customer = Object.fromEntries(formData.entries());
        
        if (checkoutItems.length === 0) {
            alert('Your cart is empty!');
            return;
        }

        const totalValue = checkoutItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        // Prep data for backend
        formData.append('items', JSON.stringify(checkoutItems));
        formData.append('total', totalValue);
        formData.append('_token', '{{ csrf_token() }}');

        try {
            const response = await fetch('{{ route('checkout.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();
            if (!result.success) {
                console.error('Order placement failed:', result);
                alert('Something went wrong. Please try again.');
                return;
            }

            // Success! Clear cart and show success overlay
            localStorage.removeItem('cart');
            
            // Show success overlay
            document.getElementById('order-success-overlay').style.display = 'flex';
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
        } catch (error) {
            console.error('Error placing order:', error);
            alert('An error occurred. Please try again.');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderCheckoutSummary();
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
