<x-layout>
    <!-- Shop Content -->
    <div class="container mx-auto px-20 py-12">
        <div class="flex max-w-md mb-10 mx-auto">
            <input type="text" placeholder="Search An Item" class="search-input flex-1 px-6 py-4 rounded-l-full font-body text-gray-700 border-none focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <button class="bg-yellow-600 hover:bg-yellow-700 px-8 py-4 rounded-r-full transition duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
        </div>

        <!-- Filter Section -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex gap-4">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body">
                    <option>All Categories</option>
                    <option>Necklaces</option>
                    <option>Earrings</option>
                    <option>Bracelets</option>
                    <option>Rings</option>
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body">
                    <option>Sort by Price</option>
                    <option>Low to High</option>
                    <option>High to Low</option>
                </select>
            </div>
            <div class="font-body text-gray-600">
                Showing 12 of 48 products
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <!-- Product Card 1 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="aspect-square bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                    <div class="w-20 h-16 bg-pink-300 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">💎</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-body font-semibold text-gray-800 mb-2">Diamond Necklace</h3>
                    <p class="font-body text-gray-600 text-sm mb-3">Elegant diamond necklace</p>
                    <p class="font-body text-yellow-600 font-bold text-lg">Rp 2,500,000</p>
                    <button class="w-full mt-4 bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-lg font-body font-medium transition duration-300">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="aspect-square bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                    <div class="w-20 h-16 bg-blue-300 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">👂</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-body font-semibold text-gray-800 mb-2">Pearl Earrings</h3>
                    <p class="font-body text-gray-600 text-sm mb-3">Classic pearl earrings</p>
                    <p class="font-body text-yellow-600 font-bold text-lg">Rp 1,200,000</p>
                    <button class="w-full mt-4 bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-lg font-body font-medium transition duration-300">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="aspect-square bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                    <div class="w-20 h-16 bg-purple-300 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">💍</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-body font-semibold text-gray-800 mb-2">Gold Ring</h3>
                    <p class="font-body text-gray-600 text-sm mb-3">Elegant gold ring</p>
                    <p class="font-body text-yellow-600 font-bold text-lg">Rp 3,200,000</p>
                    <button class="w-full mt-4 bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-lg font-body font-medium transition duration-300">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="aspect-square bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                    <div class="w-20 h-16 bg-green-300 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">📿</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-body font-semibold text-gray-800 mb-2">Silver Bracelet</h3>
                    <p class="font-body text-gray-600 text-sm mb-3">Modern silver bracelet</p>
                    <p class="font-body text-yellow-600 font-bold text-lg">Rp 800,000</p>
                    <button class="w-full mt-4 bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-lg font-body font-medium transition duration-300">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Repeat similar product cards... -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <div class="flex gap-2">
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 font-body">Previous</button>
                <button class="px-4 py-2 bg-yellow-600 text-white rounded-lg font-body">1</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 font-body">2</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 font-body">3</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 font-body">Next</button>
            </div>
        </div>
    </div>
</x-layout>
