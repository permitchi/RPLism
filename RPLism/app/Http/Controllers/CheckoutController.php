<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        $user = Auth::user();
        return view('checkout.index', compact('user'));
    }

    /**
     * Process the checkout form
     */
    public function process(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'shipping_method' => 'required|string',
            'payment_method' => 'required|string',
            'order_total' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();

            // Save address information if requested
            if ($request->has('save_info')) {
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_num' => $request->phone,
                    'street_address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ]);
            }

            // TODO: Create order record
            // TODO: Process payment
            // TODO: Clear cart
            // TODO: Send confirmation email


            // Create a new transaction after successful checkout
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'status' => 'pending',
                // Add more fields as needed, e.g. total, shipping info, etc.
                'total' => $request->order_total,
            ]);

            DB::commit();

            // Pass shipping info and total to success page via session
            $shipping = [
                'name' => $request->first_name . ' ' . $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ];
            $orderTotal = $request->order_total;

            return redirect()->route('checkout.success')
                ->with('success', 'Order placed successfully!')
                ->with('shipping', $shipping)
                ->with('order_total', $orderTotal);

        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Something went wrong while processing your order. Please try again.']);
        }
    }

    /**
     * Display the success page
     */
    public function success(Request $request)
    {
        $user = Auth::user();
        $shipping = session('shipping');
        $orderTotal = session('order_total');
        // Get the latest transaction for this user (just created in process)
        $transaction = Transaction::where('user_id', $user->id)->latest()->first();
        return view('checkout.success', compact('user', 'shipping', 'transaction', 'orderTotal'));
    }
}
