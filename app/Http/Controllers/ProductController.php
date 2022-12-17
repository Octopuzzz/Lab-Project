<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::query();
        return view('page.Home', [
            'Products' => $data->filter(request(['search']))->paginate(6),
            'title' => 'Home'
        ]);
    }
    public function show(Product $product)
    {
        return view('page.Detail', [
            'Product' => $product,
            'title' => 'Product'
        ]);
    }
    public function removeProduct(Product $product)
    {
        $product->destroy($product->ProductID);
        return redirect(route('home'))->with('success', 'Product removed');
    }
    public function removeProductDashBoard(Product $product)
    {
        $product->destroy($product->ProductID);
        return redirect()->back()->with('success', 'Product removed');
    }

    public function addProduct()
    {
        return view('page.admin.AddProduct', [
            'title' => 'Add Product'
        ]);
    }
    public function storeProduct(Request $request)
    {
        $request->validate([
            'ProductName' => 'required',
            'ProductPrice' => 'required',
            'ProductDescription' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'ProductDescription' => 'required',
            'Stock' => 'required|min:1',
            'Year' => 'required'
        ]);
        // Image
        $files = $request->file('image');
        $fileFullName = $files->getClientOriginalName();
        $fileName = pathinfo($fileFullName, PATHINFO_FILENAME);
        $fileExtension = $files->getClientOriginalExtension();
        $fileToStore = $fileName . '-' . time() . '.' . $fileExtension;
        $files->storeAs('product-image', $fileToStore);
        // Store To DB
        $product = new Product();
        $product->UserID = auth()->user()->UserID;
        $product->name = $request->ProductName;
        $product->price = $request->ProductPrice;
        $product->stock = $request->ProductStock;
        $product->image = $fileToStore;
        $product->year = $request->Year;
        $product->description = $request->ProductDescription;
        $product->stock = $request->Stock;
        $product->save();
        return redirect(route('admin'))->with('success', 'Product added');
    }
}
