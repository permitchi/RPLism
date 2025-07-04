<x-layout>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        
        <!-- Product Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Product Image</label>
            <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2 mt-1" accept="image/*">
            @if($product->image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Current image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current product image" class="w-32 h-24 object-cover rounded mt-1">
                </div>
            @endif
        </div>
        
        <!-- Product Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        
        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2 mt-1" required>{{ old('description', $product->description) }}</textarea>
        </div>
        
        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2 mt-1" step="0.01" required>
        </div>
        
        <!-- Stock Quantity -->
        <div class="mb-4">
            <label for="stock" class="block text-gray-700">Stock Quantity</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="w-full border rounded px-3 py-2 mt-1" min="0" required>
        </div>
        
        <!-- Featured Product -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_featured" id="is_featured" class="mr-2" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
            <label for="is_featured" class="text-gray-700">Featured Product</label>
        </div>
        
        <!-- Active Status -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
            <label for="is_active" class="text-gray-700">Active Product</label>
        </div>
        
        <!-- Buttons -->
        <div class="flex gap-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Update Product</button>
            <a href="{{ url()->previous() }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancel</a>
        </div>
    </form>
</div>
</x-layout>
