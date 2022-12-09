<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::where('UserID', auth()->user()->UserID)->first();
        return view('page.user.profile', [
            'title' => 'Profile',
            'user' => $user
        ]);
    }
    public function EditProfile(Request $request)
    {
        $request->validate([
            'name' => 'required:min:3',
            'email' => 'required|email:dns,email' . auth()->user()->UserID . ',UserID',
            'address' => 'required|min:5',
            'new_password' => 'required|min:5'
        ]);
        if (Hash::check($request->password, auth()->user()->password)) {
            User::where('UserID', auth()->user()->UserID)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->route('profile')->with('success', 'Profile Updated');
        }
        throw ValidationException::withMessages([
            'password' => 'The provided password is incorrect.'
        ]);
    }
}
