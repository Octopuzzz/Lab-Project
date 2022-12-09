<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            'profile_name' => 'required|min:5',
            'email' => 'required|email:dns|unique:users,email,' . auth()->id() . ',UserID',
            'address' => 'required|min:5',
            'new_password' => 'nullable|min:5',
            'current_password' => 'required',
        ]);
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $user = User::where('UserID', auth()->id());
            if ($request->new_password) {
                $password = Hash::make($request->new_password);
                $user->update([
                    'name' => $request->profile_name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'password' => $password
                ]);
            }else{
                $user->update([
                    'name' => $request->profile_name,
                    'email' => $request->email,
                    'address' => $request->address,
                ]);
            }
            // User::where('UserID', auth()->id())->update([
            //     'name' => $request->profile_name,
            //     'email' => $request->email,
            //     'address' => $request->address,
            //     'password' => $password
            // ]);
            return redirect()->route('profile.show')->with('success', 'Profile Updated');
        }
        throw ValidationException::withMessages([
            'current_password' => 'The provided password is incorrect'
        ]);
    }
}
