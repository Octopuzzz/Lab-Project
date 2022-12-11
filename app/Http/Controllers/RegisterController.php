<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('partials.register', [
            'title' => 'Register'
        ]);
    }
    public function store(PostRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $request['isAdmin'] = $request->isAdmin ? true : false;
        if ($request->hasFile('image')) {
            $request['image'] = $request->file('image')->store('images');
        }
        // dd($request->all(), $request->image);
        User::create($request->all());
        return redirect(route('login'))->with('success', 'Register Success');
    }
}
