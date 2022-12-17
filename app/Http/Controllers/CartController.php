<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\HeaderTransaction;
use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

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
    public function Checkout($total_price)
    {
        $product = null;
        $ErrorItem = [];
        $flag = true;
        $data = Cart::all();
        if (Auth::check()) {
            foreach ($data as $item) {
                $product = Product::where('ProductID', $item->ProductID)->first();
                if ($product == null) {
                    return redirect(route('MyCart'))->with('message', "You Can't select unlisted item !");
                } else if ($product->stock < $item->Quantity) {
                    $ErrorItem[] = $product->name;
                    $flag = false;
                }
            }
            if (!$flag) {
                return redirect(route('MyCart'))->with('message', "You Can't select item that out of stock !")->with('ErrorItem', $ErrorItem);
            }
            $HeaderTransaction = HeaderTransaction::create([
                'UserID' => Auth::user()->UserID,
                'Total_Price' => $total_price,
                'Status' => 'Pending'
            ]);
            foreach ($data as $item) {
                $DetailTransaction = new TransactionDetail();
                $product = Product::where('ProductID', $item->ProductID)->first();
                $product->stock -= $item->Quantity;
                $product->save();
                $DetailTransaction->HeaderID = $HeaderTransaction->HeaderTransactionID;
                $DetailTransaction->ProductID = $item->ProductID;
                $DetailTransaction->Quantity = $item->Quantity;
                $DetailTransaction->Sub_Total = $item->TotalPrice;
                $DetailTransaction->save();
            }
            Cart::truncate();
        }
        return redirect(route('MyCart'))->with('success', 'Checkout success !');
    }
}
