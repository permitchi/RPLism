<x-layout>
    @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6">My Products</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b text-left">Image</th>
                            <th class="px-6 py-3 border-b text-left">Name</th>
                            <th class="px-6 py-3 border-b text-left">Description</th>
                            <th class="px-6 py-3 border-b text-left">Price</th>
                            <th class="px-6 py-3 border-b text-left">Featured</th>
                            <th class="px-6 py-3 border-b text-left">Created At</th>
                            <th class="px-6 py-3 border-b text-left">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="px-6 py-4 border-b">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded" />
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-b">{{ $product->name }}</td>
                                <td class="px-6 py-4 border-b">{{ $product->description }}</td>
                                <td class="px-6 py-4 border-b">Rp{{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 border-b">
                                    @if($product->is_featured)
                                        <span class="text-yellow-600 font-bold">Yes</span>
                                    @else
                                        <span class="text-gray-500">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-b">{{ $product->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 border-b text-center">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-8">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="container mx-auto py-8">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-lg mx-auto" role="alert">
                <strong class="font-bold">Access Denied!</strong>
                <span class="block sm:inline"> You do not have permission to access this page.</span>
            </div>
        </div>
    @endif
</x-layout>
