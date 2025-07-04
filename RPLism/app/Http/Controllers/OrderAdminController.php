<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OrderAdminController extends Controller
{
    // List all transactions for admin

    public function index()
    {
        // Only allow admin users
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        $orders = Transaction::orderBy('created_at', 'desc')->get();
        return view('pages.adminorders', compact('orders'));
    }

    // Update transaction status
    public function updateStatus(Request $request, $id)
    {
        // Only allow admin users
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'status' => 'required|in:pending,on going,finished',
        ]);
        $order = Transaction::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
