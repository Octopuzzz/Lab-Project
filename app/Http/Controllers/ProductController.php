<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;

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
}
