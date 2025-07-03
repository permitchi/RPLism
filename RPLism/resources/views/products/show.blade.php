<x-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 flex items-center justify-center bg-gradient-to-br from-pink-100 to-pink-200 p-8">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg" />
                @else
                    <div class="w-full h-96 bg-pink-300 rounded-lg flex items-center justify-center">
                        <span class="text-6xl">💎</span>
                    </div>
                @endif
            </div>
            <div class="md:w-1/2 p-8 flex flex-col justify-center">
                <h2 class="text-3xl font-bold mb-4">{{ $product->name }}</h2>
                <p class="text-lg text-gray-700 mb-4">{{ $product->description }}</p>
                <p class="text-2xl text-yellow-600 font-bold mb-4">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $product->is_featured ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-200 text-gray-500' }}">
                        {{ $product->is_featured ? 'Featured Product' : 'Regular Product' }}
                    </span>
                </div>
                <div class="mb-4 text-gray-500 text-sm">Added on: {{ $product->created_at->format('Y-m-d') }}</div>
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded text-lg mt-4">Add to Cart</button>
            </div>
        </div>
    </div>
</x-layout>
