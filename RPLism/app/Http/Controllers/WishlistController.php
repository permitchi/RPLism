<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();
            
        return view('pages.wishlist', compact('wishlists'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // Check if already in wishlist
        $existingWishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingWishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in your wishlist'
            ]);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist successfully!'
        ]);
    }

    public function remove($productId)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in wishlist'
        ]);
    }

    public function clear()
    {
        $userId = Auth::id();
        
        Wishlist::where('user_id', $userId)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Wishlist cleared successfully'
        ]);
    }
}
