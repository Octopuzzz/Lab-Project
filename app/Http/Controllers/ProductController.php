<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::paginate(6);
        return view('page.Home', [
            'Products' => $data,
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
