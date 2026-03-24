@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="background-image: url('{{ asset('assets/images/hero_background.png') }}');">
        <div class="hero-content">
            <h1>Fresh from the <span>Farm</span></h1>
            <p>Organic and locally grown produce delivered to your doorstep from Zafarwal Mandi.</p>
            <a href="#" class="btn btn-primary" style="padding: 15px 35px; font-size: 1.1rem;">Shop Now <i data-lucide="arrow-right" style="width: 18px; display: inline-block; vertical-align: middle; margin-left: 5px;"></i></a>
            
            <div class="features-ribbon">
                <div class="feature-box">
                    <div class="feature-icon"><i data-lucide="truck" style="color: white; width:20px;"></i></div>
                    <div class="feature-text">
                        <h4>Free Shipping</h4>
                        <p>Orders over Rs.500</p>
                    </div>
                </div>
                <div class="feature-box">
                    <div class="feature-icon"><i data-lucide="leaf" style="color: white; width:20px;"></i></div>
                    <div class="feature-text">
                        <h4>Fresh Produce</h4>
                        <p>Direct from farm</p>
                    </div>
                </div>
                <div class="feature-box">
                    <div class="feature-icon"><i data-lucide="shield-check" style="color: white; width:20px;"></i></div>
                    <div class="feature-text">
                        <h4>Secure Payment</h4>
                        <p>100% secure checkout</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories">
        <div class="container">
            <h2 class="section-title">Shop by Category</h2>
            <p style="text-align: center; color: var(--text-light); margin-top: -20px; margin-bottom: 40px;">Explore our wide selection of fresh product categories.</p>
            
            <div class="category-grid">
                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/category_vegetables.png') }}" alt="Vegetables">
                    <div class="category-info">
                        <h3>Vegetables</h3>
                        <p>20 products</p>
                    </div>
                </a>
                
                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/category_fruits.png') }}" alt="Fruits">
                    <div class="category-info">
                        <h3>Fruits</h3>
                        <p>15 products</p>
                    </div>
                </a>
                
                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/category_juices.png') }}" alt="Juices">
                    <div class="category-info">
                        <h3>Juices</h3>
                        <p>8 products</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <x-featured-products />

    <!-- Deal of the Day -->
    <section class="deal">
        <div class="container deal-container">
            <div class="deal-content">
                <div class="deal-badge"><i data-lucide="flame" style="width: 16px; display: inline-block; vertical-align: middle;"></i> Deal of the Day</div>
                <h2 class="deal-title">Fresh Red Tomatoes</h2>
                <p class="deal-desc">Premium quality tomatoes, perfect for salads, curries, and sauces. Grown locally in Zafarwal region.</p>
                
                <div class="deal-price">
                    Rs.30 <del>Rs.50</del> <span class="discount">40% OFF</span>
                </div>
                
                <p style="color: var(--text-light); margin-bottom: 15px; font-weight: 500;"><i data-lucide="clock" style="width: 16px; display: inline-block; vertical-align: middle;"></i> Offers ends in:</p>
                <div class="timer">
                    <div class="timer-box">
                        <span>02</span>
                        <small>Days</small>
                    </div>
                    <div class="timer-box">
                        <span>14</span>
                        <small>Hours</small>
                    </div>
                    <div class="timer-box">
                        <span>35</span>
                        <small>Mins</small>
                    </div>
                    <div class="timer-box">
                        <span>31</span>
                        <small>Secs</small>
                    </div>
                </div>
                
                <button class="btn btn-primary" style="padding: 15px 35px; font-size: 1.1rem;"><i data-lucide="shopping-cart" style="width: 18px; display: inline-block; vertical-align: middle; margin-right: 5px;"></i> Add to Cart</button>
            </div>
            
            <div class="deal-image">
                <div class="deal-tag">
                    <span>40%</span>
                    <small>OFF</small>
                </div>
                <img src="{{ asset('assets/images/deal_tomatoes.png') }}" alt="Tomatoes Deal">
                <div style="text-align: center; margin-top: 15px;">
                    <span style="background: rgba(14, 166, 48, 0.1); color: var(--primary-green); padding: 5px 15px; border-radius: 20px; font-weight: 600;">Only 15 kg left in stock!</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <p style="color: var(--text-light); margin-top: -20px;">Hear from our satisfied customers about their experience with Zafarwal Mandi.</p>
            
            <div class="testimonial-card">
                <div class="quote-icon"><i data-lucide="quote"></i></div>
                <div class="stars">★★★★★</div>
                <p class="testimonial-text">"Great service and fresh produce. The strawberries were delicious! Would love to see more variety."</p>
                
                <div class="customer-info">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=150&q=80" alt="Customer">
                    <h5>Maria Asghar</h5>
                    <p>Verified Customer</p>
                </div>
            </div>
        </div>
    </section>

@endsection
