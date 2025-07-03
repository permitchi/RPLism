<x-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-8">Search Results</h1>
        @if(isset($query) && $query)
            <p class="mb-6 text-gray-600">Showing results for: <span class="font-semibold">{{ $query }}</span></p>
        @endif
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                    <div class="aspect-square bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-16 object-contain rounded-lg" />
                        @else
                            <div class="w-20 h-16 bg-pink-300 rounded-lg flex items-center justify-center">
                                <span class="text-2xl">💎</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-body font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="font-body text-yellow-600 font-bold">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">No products found.</div>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-layout>
