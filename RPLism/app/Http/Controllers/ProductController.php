<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.myproducts')->with('success', 'Product deleted successfully.');
    }
    /**
     * Display a listing of all products for admin.
     */
    public function myProducts()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('pages.myproducts', compact('products'));
    }
    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Only allow admins to add products
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle is_featured checkbox
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        Product::create($validated);

        return redirect()->route('homepage')->with('success', 'Product added successfully!');
    }
    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        // Only allow admins to update products
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                unlink(storage_path('app/public/' . $product->image));
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle checkboxes
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // Update the product
        $product->update($validated);

        return redirect()->route('products.show', $product->id)->with('success', 'Product updated successfully!');
    }
}
