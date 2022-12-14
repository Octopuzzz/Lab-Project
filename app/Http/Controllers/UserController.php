<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096'
        ]);
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $user = User::where('UserID', auth()->id())->first();
            $user->name = $request->profile_name;
            $user->email = $request->email;
            $user->address = $request->address;
            if ($request->new_password) {
                $password = Hash::make($request->new_password);
                $user->password = $password;
            }
            if ($request->hasFile('profile_image')) {
                if ($request->oldImage) {
                    Storage::delete('user-image/' . $request->oldImage);
                }
                $files = $request->file('profile_image');
                $fileFullName = $files->getClientOriginalName();
                $fileName = pathinfo($fileFullName, PATHINFO_FILENAME);
                $extension = $files->getClientOriginalExtension();
                $image = $fileName . "-" . time() . "." . $extension;
                $files->storeAs('user-image', $image);
                $user->image = $image;
            }
            $user->save();
            // $user->update([
            //     'name' => $request->profile_name,
            //     'email' => $request->email,
            //     'address' => $request->address,
            //     'password' => $password
            // ]);
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
