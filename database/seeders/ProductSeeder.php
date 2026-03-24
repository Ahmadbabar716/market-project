<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Premium Wireless Headphones',
                'description' => 'Experience crystal-clear audio with our premium noise-cancelling wireless headphones. Featuring 30-hour battery life and superior comfort.',
                'price' => 299.99,
                'image' => null,
                'featured' => true,
                'sort_order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Smart Watch Pro',
                'description' => 'Track your fitness, receive notifications, and stay connected with our advanced smartwatch. Water-resistant with 7-day battery life.',
                'price' => 449.99,
                'image' => null,
                'featured' => true,
                'sort_order' => 2,
                'active' => true,
            ],
            [
                'name' => '4K Webcam Ultra',
                'description' => 'Professional-grade 4K webcam with auto-focus and low-light correction. Perfect for streaming and video calls.',
                'price' => 179.99,
                'image' => null,
                'featured' => true,
                'sort_order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Mechanical Keyboard RGB',
                'description' => 'Premium mechanical keyboard with customizable RGB backlighting and hot-swappable switches. Built for gamers and professionals.',
                'price' => 159.99,
                'image' => null,
                'featured' => false,
                'sort_order' => 0,
                'active' => true,
            ],
            [
                'name' => 'Portable SSD 1TB',
                'description' => 'Ultra-fast portable SSD with 1TB storage capacity. Shock-resistant and compact design for on-the-go storage.',
                'price' => 129.99,
                'image' => null,
                'featured' => false,
                'sort_order' => 0,
                'active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
