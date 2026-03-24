<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Featured Products Management</h2>
                    <p class="mt-2 text-amber-100">Manage products that appear in the featured section of your website</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-sm text-amber-100">Total Featured</div>
                        <div class="text-2xl font-bold">{{ \App\Models\Product::where('featured', true)->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Products Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            {{ $this->table }}
        </div>

        <!-- Tips Section -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-3">💡 Tips for Managing Featured Products</h3>
            <ul class="space-y-2 text-blue-800">
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>Use the "Sort Order" field to control the display order of featured products</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>Only active products will be displayed on the frontend</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>High-quality images (800x800px recommended) work best for featured products</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>Keep descriptions concise but informative for better user experience</span>
                </li>
            </ul>
        </div>
    </div>
</x-filament-panels::page>
