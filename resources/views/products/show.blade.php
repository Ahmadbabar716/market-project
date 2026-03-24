@extends('welcome')

@section('content')
<!-- Product Detail Section -->
<section class="featured" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="product-detail-img">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="border-radius:10px; width: 100%; height: auto;">
                    @else
                        <img src="https://images.unsplash.com/photo-1560806887-1e4cd0b6fac6?auto=format&fit=crop&w=600&q=80" alt="{{ $product->name }}" style="border-radius:10px; width: 100%; height: auto;">
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-detail-info">
                    @if($product->featured)
                        <span class="badge">Featured</span>
                    @endif
                    
                    <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; color: var(--text-dark);">{{ $product->name }}</h1>
                    
                    <div class="product-rating" style="margin-bottom: 20px;">
                        ★★★★★
                    </div>
                    
                    <p style="color: var(--text-light); font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px;">{{ $product->description }}</p>
                    
                    <div class="product-footer" style="margin-bottom: 30px;">
                        <div class="price" style="font-size: 2rem; font-weight: 700; color: var(--primary-color);">
                            Rs.{{ number_format($product->price, 2) }}
                        </div>
                    </div>
                    
                    <div class="product-actions" style="display: flex; gap: 15px; margin-bottom: 30px;">
                        <button class="btn btn-primary" style="padding: 12px 30px; font-size: 1rem;">
                            <i data-lucide="shopping-cart" style="width: 18px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                            Add to Cart
                        </button>
                        <button class="btn btn-outline" style="padding: 12px 20px;">
                            <i data-lucide="heart" style="width: 18px; display: inline-block; vertical-align: middle;"></i>
                        </button>
                    </div>
                    
                    <div class="product-meta">
                        <div style="display: flex; gap: 30px; margin-bottom: 20px;">
                            <div>
                                <strong>Availability:</strong> 
                                @if($product->active)
                                    <span style="color: green;">In Stock</span>
                                @else
                                    <span style="color: red;">Out of Stock</span>
                                @endif
                            </div>
                            <div>
                                <strong>Category:</strong> Fresh Produce
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 30px;">
                            <div>
                                <i data-lucide="truck" style="width: 16px; display: inline-block; vertical-align: middle; margin-right: 5px;"></i>
                                Fast Delivery
                            </div>
                            <div>
                                <i data-lucide="shield-check" style="width: 16px; display: inline-block; vertical-align: middle; margin-right: 5px;"></i>
                                Quality Guarantee
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="featured" style="background: var(--bg-light);">
    <div class="container">
        <div class="featured-header">
            <div>
                <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 10px; color: var(--text-dark);">Related Products</h2>
                <p>You might also like these products</p>
            </div>
        </div>
        
        <div class="product-grid">
            @php
                $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)->active()->take(4)->get();
            @endphp
            
            @forelse($relatedProducts as $relatedProduct)
                <div class="product-card">
                    @if($relatedProduct->featured)
                        <span class="badge">Featured</span>
                    @endif
                    
                    @if($relatedProduct->image)
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="product-img" style="border-radius:10px;">
                    @else
                        <img src="https://images.unsplash.com/photo-1560806887-1e4cd0b6fac6?auto=format&fit=crop&w=400&q=80" alt="{{ $relatedProduct->name }}" class="product-img" style="border-radius:10px;">
                    @endif
                    
                    <div class="product-rating">
                        ★★★★★
                    </div>
                    <h3 class="product-title">{{ $relatedProduct->name }}</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">{{ Str::limit($relatedProduct->description, 50) }}</p>
                    <div class="product-footer">
                        <div class="price">Rs.{{ number_format($relatedProduct->price, 2) }}</div>
                    </div>
                    <button class="btn add-cart">
                        <i data-lucide="shopping-cart" style="width: 16px; display: inline-block; vertical-align: middle; margin-right: 5px;"></i> 
                        Add to Cart
                    </button>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p>No related products found</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
