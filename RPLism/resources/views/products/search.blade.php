<x-layout>
    <div class="container mx-auto py-12">
        <!-- Search Bar -->
        <form action="{{ route('products.search') }}" method="GET" class="flex max-w-md mb-10 mx-auto">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search An Item" class="search-input flex-1 px-6 py-4 rounded-l-full font-body text-gray-700 border-none focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 px-8 py-4 rounded-r-full transition duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>
        <h1 class="text-3xl font-bold mb-8">Search Results</h1>
        @if(isset($query) && $query)
            <p class="mb-2 text-gray-600">Showing results for: <span class="font-semibold">{{ $query }}</span></p>
        @endif
        <p class="mb-6 text-gray-600">
            Showing
    
            <span class="font-semibold">
                {{ $products->lastItem() ?? 0 }}
            </span>
            of
            <span class="font-semibold">
                {{ $products->total() }}
            </span>
            products
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
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
                        <div class="flex flex-col flex-1 p-4">
                            <h3 class="font-body font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="font-body text-yellow-600 font-bold mb-4">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
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
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-layout>
