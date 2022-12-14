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
            $files = $request->file('image');
            $fileFullname = $files->getClientOriginalName();
            $fileName = pathinfo($fileFullname, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $image = $fileName . "-" . time() . "." . $extension;
            $files->storeAs('user-image', $image);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'isAdmin' => $request->isAdmin,
            'image' => $image,
            'address' => $request->address,
            'gender' => $request->gender
        ]);
        return redirect(route('login'))->with('success', 'Register Success');
    }
}
