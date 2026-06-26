<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Product $product){
        $cart=session()->get('cart',[]);
        return view('cart.index', compact('cart'));
    }

    // public function add(Request $request, Product $product ){

    //     $quantity = (int) $request->input('quantity', 1);
        
    //     $cart=session()->get('cart',[]);
    //     if(isset($cart[$product->id])){
    //         // $cart[$product->id]['quantity']++;
    //          $cart[$product->id]['quantity'] += $quantity;
    //     }else{
    //         $cart[$product->id]=[
    //             'name'=>$product->name,
    //             'price'=>$product->price,
    //             'quantity' => $quantity,
    //             'image'=>$product->image
    //         ];
    //     }

    //     session()->put('cart',$cart);
    //     return redirect()->back()->with('success',$product->name.'Ajouter au panier !');

    // }

    // Ajouter au panier (route: POST /produits/{id})
    public function store(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $quantity = (int) $request->input('quantity', 1);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
         $cart[$id]['quantity'] += $quantity;
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            "quantity" => $quantity,
        ];
    }

    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'message' => 'Produit ajouté au panier',
        'cart_count' => count($cart),
        
    ]);
}
 

    public function remove(Product $product){
        $cart=session()->get('cart',[]);

        if(isset($cart[$product->id])){
            unset($cart[$product->id]);
            session()->put('cart',$cart);
        }

        return redirect()->back()->with('success',$product->name.'Supprime du panier !');
    }

    public function update(Request $request, $id)
    {
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $quantity = (int) $request->quantity;
        if ($quantity < 1) $quantity = 1;

        $cart[$id]['quantity'] = $quantity;
        session()->put('cart', $cart);
    }

    // Recalculate total
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return response()->json([
        'success' => true,
        'quantity' => $cart[$id]['quantity'],
        'total' => $total,
        'product_total' => $cart[$id]['price'] * $cart[$id]['quantity'],
        'cart_count' => array_sum(array_column($cart, 'quantity')),
    ]);
    }
}
