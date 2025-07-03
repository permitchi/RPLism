<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Ambil produk yang featured dan aktif, maksimal 8 produk
        $products = Product::active()
            ->featured()
            ->take(8)
            ->get();

        return view('homepage.index', compact('products'));
    }

    /**
     * Search products.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        $products = Product::active()
            ->where(function($q) use ($query) {
                if (!empty($query)) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%")
                      ->orWhere('category', 'like', "%{$query}%");
                }
            })
            ->paginate(12);

        return view('pages.search', compact('products', 'query'));
    }
}
