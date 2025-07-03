<x-layout>
    <div class="container mx-auto py-12">
        <!-- Back Button -->
        <div class="mb-6">
            @php
                $adminPages = [
                    route('addproduct', [], false),
                    route('products.myproducts', [], false),
                    route('editproduct', ['id' => $product->id], false)
                ];
                $previous = url()->previous();
                $current = url()->current();
                $backUrl = route('shop');
                if ($previous !== $current && !Str::contains($previous, $adminPages)) {
                    $backUrl = $previous;
                }
            @endphp
            <a href="{{ $backUrl }}" class="inline-flex items-center px-4 py-2 text-red-500 rounded-full font-body font-medium transition mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Shop
            </a>
        </div>
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 flex items-center justify-center p-8">
                <div class="w-full aspect-square max-w-[32rem]">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-2xl shadow-lg" />
                    @else
                        <div class="w-full h-full bg-pink-300 rounded-2xl flex items-center justify-center">
                            <span class="text-6xl">💎</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="md:w-1/2 p-8 flex flex-col justify-center">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-bold">{{ $product->name }}</h2>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('editproduct', ['id' => $product->id]) }}" class="ml-2 text-black hover:text-gray-700" title="Edit Product">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L9 13zm-6 6h6" />
                            </svg>
                        </a>
                    @endif
                </div>
                <div class="mb-4 flex items-center gap-2">
                    @if($product->is_featured)
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                            Featured Product
                        </span>
                    @endif
                </div>
                <p class="text-lg text-gray-700 mb-4">{{ $product->description }}</p>
                <p class="text-2xl text-yellow-600 font-bold mb-4">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                <div class="mb-4 text-gray-500 text-sm">Added on: {{ $product->created_at->format('Y-m-d') }}</div>
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded text-lg mt-4">Add to Cart</button>
            </div>
        </div>
    </div>
</x-layout>
