@php
    $featuredProducts = App\Models\Product::featured()->take(12)->get();
@endphp

@if($featuredProducts->count() > 0)
<section class="featured">
    <div class="container">
        <div class="featured-header">
            <div>
                <h2 class="section-title" style="text-align: left; margin-bottom: 8px;">Featured Products</h2>
                <p>Handpicked selection of premium fresh produce from Zafarwal Mandi.</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline">View All <i data-lucide="arrow-right" style="width:16px; display:inline-block; vertical-align:middle; margin-left:4px;"></i></a>
        </div>

        <div class="product-grid">
            @foreach($featuredProducts as $product)
            <div class="product-card">
                {{-- Featured Badge --}}
                @if($product->featured)
                    <span class="badge">⭐ Featured</span>
                @endif

                {{-- Wishlist Icon --}}
                <button class="wishlist-btn" title="Add to Wishlist">
                    <i data-lucide="heart" style="width:18px;"></i>
                </button>

                {{-- Product Image --}}
                <div class="product-img-wrap">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="product-img">
                    @else
                        <div class="product-img-placeholder">
                            <i data-lucide="image" style="width:40px; color: #ccc;"></i>
                        </div>
                    @endif
                </div>

                {{-- Product Info --}}
                <h3 class="product-title">{{ $product->name }}</h3>
                <div class="product-rating">★★★★☆ <span style="color: var(--text-light); font-size:0.85rem;">({{ rand(10, 120) }})</span></div>

                @if($product->description)
                    <p style="color: var(--text-light); font-size: 0.88rem; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $product->description }}
                    </p>
                @endif

                <div class="product-footer">
                    <div class="price">Rs.{{ number_format($product->price, 0) }} <span style="font-size: 0.9rem; color: var(--text-light); font-weight: 400;">/kg</span></div>
                </div>

                <div class="quantity-selector-container">
                    <span class="qty-label">Qty:</span>
                    <div class="qty-controls">
                        <button type="button" class="qty-btn minus" onclick="updateQuantity(this, -0.5)">−</button>
                        <span class="qty-display" data-value="1">1 kg</span>
                        <button type="button" class="qty-btn plus" onclick="updateQuantity(this, 0.5)">+</button>
                    </div>
                </div>

                <button class="btn add-cart" style="background: var(--primary-green); color: white;"
                        data-price="{{ $product->price }}"
                        onclick="addToCart(this)">
                    <i data-lucide="shopping-cart" style="width:16px; display:inline-block; vertical-align:middle; margin-right:6px;"></i>
                    Add to Cart
                </button>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('products.index') }}" class="btn btn-outline" style="padding: 12px 30px; font-size: 1.05rem;">
                View More Products <i data-lucide="arrow-right" style="width: 18px; display: inline-block; vertical-align: middle; margin-left: 5px;"></i>
            </a>
        </div>
    </div>
</section>

<script>
    function updateQuantity(btn, change) {
        const container = btn.closest('.qty-controls');
        const display = container.querySelector('.qty-display');
        let currentValue = parseFloat(display.getAttribute('data-value')) || 1;
        
        let newValue = currentValue + change;
        if (newValue < 0.5) newValue = 0.5; // Minimum 0.5
        if (newValue > 50) newValue = 50;   // Maximum limit

        display.setAttribute('data-value', newValue);
        
        // Format to display properly
        display.textContent = Number.isInteger(newValue) ? newValue + ' kg' : newValue.toFixed(1) + ' kg';
    }
</script>
@endif
