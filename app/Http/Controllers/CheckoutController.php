<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class CheckoutController extends Controller
{
     public function index()
    {
        $cart = session()->get('cart', []);
        if(count($cart) == 0){
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide!');
        }
        return view('checkout.index', compact('cart'));
    }


    public function direct(Product $product)
    {

         $cart = session()->get('cart', []);
        // Create a temporary "cart" with just this product
        // If product already in cart, increment quantity
        if (isset($cart[$product->id])) {   
          $cart[$product->id]['quantity'] += 1;  
        } else {
        // Add the product
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => 1,
        ];
    }

    // Store in session
    session(['cart' => $cart]);

    // Redirect to cart page instead of checkout
    return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier avec succès ');
    }

   


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    // Create the order
    $order = Order::create([
        'customer_name' => $request->name,
        'customer_phone' => $request->phone,
        'customer_address' => $request->address,
    ]);

    $total = 0;

    // Attach products safely
    foreach ($cart as $id => $product) {
        // Skip invalid products
        if (!isset($product['price'], $product['quantity'])) continue;

        $price = $product['price'] ?? 0;
        $quantity = $product['quantity'];

        $order->products()->attach($id, [
            'quantity' => $quantity,
            'price' => $price,
        ]);

        $total += $price * $quantity;
    }

    // Reload products for message
    $order->load('products');

    // Build WhatsApp message
    $date = now()->format('d/m/Y');
    $time = now()->format('H:i');
    $message = "🧾 *Nouvelle commande enregistrée*\n";
    $message .= "📅 *Date:* {$date} à {$time}\n\n";
    $message .= "👤 *Client:* {$order->customer_name}\n";
    $message .= "📞 *Téléphone:* {$order->customer_phone}\n";
    $message .= "📍 *Adresse:* {$order->customer_address}\n\n";
    $message .= "📦 *Produits:*\n";

    foreach ($order->products as $product) {
        $subtotal = $product->pivot->price * $product->pivot->quantity;
        $message .= "- {$product->name} × {$product->pivot->quantity} → *{$subtotal} DH*\n";
    }

    $message .= "\n💰 *Total:* {$total} DH";

    $adminPhone = '212709023673';
    $whatsAppUrl = "https://wa.me/{$adminPhone}?text=" . rawurlencode($message);

    // Clear cart
    session()->forget('cart');

    return redirect()->route('cart.index')->with([
        'success' => 'Votre commande a été enregistrée avec succès !',
        'order' => $order,
        'whatsapp' => $whatsAppUrl,
    ]);
}

}
