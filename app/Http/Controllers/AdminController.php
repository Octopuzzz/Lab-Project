<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('page.admin.Dashboard', [
            'title' => 'Dashboard',
            'products' => $data
        ]);
    }
}
