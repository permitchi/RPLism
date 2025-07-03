<head>
    <title>Shop - MIINACCI</title>
</head>

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
                Showing
                <span class="font-semibold">
                    {{ $products->lastItem() ?? 0 }}
                </span>
                of
                <span class="font-semibold">
                    {{ $products->total() }}
                </span>
                products
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="block bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 h-full">
                    <div class="flex flex-col h-full">
                        <div class="aspect-square bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg" />
                            @else
                                <div class="w-full h-full bg-pink-300 rounded-lg flex items-center justify-center">
                                    <span class="text-2xl">💎</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col flex-1 p-6">
                            <h3 class="font-body font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="font-body text-gray-600 text-sm mb-3">{{ $product->description }}</p>
                            <p class="font-body text-yellow-600 font-bold text-lg mb-4">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                            <div class="mt-auto">
                                <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-lg font-body font-medium transition duration-300" onclick="event.preventDefault();">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-4 text-center text-gray-500">No products found.</div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            {{ $products->links() }}
        </div>
    </div>
</x-layout>
