<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeaderTransaction;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $data = HeaderTransaction::where('UserID', auth()->id())->get();
        return view('page.user.History', [
            'title' => 'History',
            'item' => $data,
        ]);
    }
}
