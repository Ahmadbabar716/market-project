<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'landmark' => 'nullable|string',
            'items' => 'required|json',
            'total' => 'required|numeric',
        ]);

        $order = Order::create([
            'customer_name' => $validated['name'],
            'customer_email' => $validated['email'],
            'customer_phone' => $validated['phone'],
            'address' => $validated['address'],
            'landmark' => $validated['landmark'],
            'total_amount' => $validated['total'],
        ]);

        $items = json_decode($validated['items'], true);
        foreach ($items as $item) {
            $order->items()->create([
                'product_name' => $item['title'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }
}
