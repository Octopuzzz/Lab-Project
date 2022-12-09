<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{
    public function MyCart()
    {
        $data = Cart::all();
        return view('page.Cart.MyCart', [
            'title' => 'My Cart',
            'items' => $data->all()
        ]);
    }
    public function AddToCart(Request $request, Product $product)
    {
        $cart = Cart::where('ProductID', $product->ProductID)->first();
        if ($cart == null) {
            Cart::create([
                'ProductID' => $product->ProductID,
                'Quantity' => $request->quantity,
                'Price' => $product->price,
                'TotalPrice' => $product->price * $request->quantity
            ]);
        } else {
            $cart->Quantity += $request->quantity;
            $cart->TotalPrice += $product->price * $request->quantity;
            $cart->save();
        }
        return redirect()->back()->with('success', 'Item added to cart');
    }
    public function RemoveFromCart(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with('success', 'Item removed from cart');
    }
    public function EditItemCart(Cart $cart)
    {
        $product = Product::where('ProductID', $cart->ProductID)->first();
        return view('page.Cart.EditCart', [
            'title' => 'Edit Cart',
            'item' => $cart,
            'Product' => $product
        ]);
    }
    public function UpdateItemCart(Request $request, Cart $cart)
    {
        $cart->Quantity = $request->quantity;
        $cart->TotalPrice = $request->quantity * $cart->Price;
        $cart->save();
        return redirect(route('MyCart'))->with('success', 'Item updated');
    }
}
