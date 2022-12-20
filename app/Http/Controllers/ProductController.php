<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
    public function editProduct(Product $product)
    {
        return view('page.admin.editProduct', [
            'Product' => $product,
            'title' => 'Edit Product'
        ]);
    }
    public function storeEditProduct(Request $request, Product $product)
    {

        $request->validate([
            'ProductName' => 'required',
            'ProductPrice' => 'required',
            'ProductDescription' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:4096',
            'ProductDescription' => 'required',
            'Stock' => 'required|min:1',
            'Year' => 'required'
        ]);
        // Image
        $Product = Product::where('ProductID', $product->ProductID)->first();
        if ($request->has('image')) {
            if ($product->image != null) {
                Storage::delete('product-image/' . $product->image);
            }
            $files = $request->file('image');
            $fileFullName = $files->getClientOriginalName();
            $fileName = pathinfo($fileFullName, PATHINFO_FILENAME);
            $fileExtension = $files->getClientOriginalExtension();
            $fileToStore = $fileName . '-' . time() . '.' . $fileExtension;
            $files->storeAs('product-image', $fileToStore);
            $Product->image = $fileToStore;
        }
        // Store To DB
        $Product->name = $request->ProductName;
        $Product->price = $request->ProductPrice;
        $Product->stock = $request->Stock;
        $Product->year = $request->Year;
        $Product->description = $request->ProductDescription;
        $Product->UserID = auth()->user()->UserID;
        $Product->save();
        return redirect(route('admin'))->with('success', 'Product edited');
    }
}
