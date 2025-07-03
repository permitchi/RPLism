<x-layout>
    @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6">Add Product</h1>
            <form action="{{ route('products.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2 mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea name="description" id="description" class="w-full border rounded px-3 py-2 mt-1" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Price</label>
                    <input type="number" name="price" id="price" class="w-full border rounded px-3 py-2 mt-1" step="0.01" required>
                </div>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Add Product</button>
            </form>
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
