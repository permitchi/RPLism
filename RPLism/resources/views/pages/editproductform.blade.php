<x-layout>
<div class="container mx-auto py-12 max-w-lg">
    <h1 class="text-3xl font-bold mb-8">Edit Product</h1>
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label class="block mb-2 font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 font-semibold">Price</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2 border rounded" required step="0.01">
        </div>
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }} class="mr-2">
                Featured Product
            </label>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded">Update</button>
            <a href="{{ url()->previous() }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
</x-layout>
