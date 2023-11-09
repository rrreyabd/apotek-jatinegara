<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile() {
        return view("user.profile-user",[
            "username"=> auth()->user()->username,
            "nomorhp"=> auth()->user()->customer->customer_phone,
            "email"=> auth()->user()->email,
        ]);
    }

    public function ubahProfile(Request $request) {
        if($request->username == auth()->user()->username && $request->nohp == auth()->user()->customer->customer_phone) {
            return redirect()->route('profile-user');
        } else {
            if ($request->username == auth()->user()->username) {
                $validated_data = $request->validate([
                    'username' => ['required', 'string', 'min:5', 'regex:/^[^\s]+$/', 'max:255'],
                    'nohp' => ['numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
                ]);
            }else {
                $validated_data = $request->validate([
                    'username' => ['required', 'string', 'min:5', 'regex:/^[^\s]+$/', 'max:255', 'unique:users'],
                    'nohp' => ['numeric', 'nullable', 'digits_between:10,14', 'starts_with:08'],
                ]);
            }
            auth()->user()->update(['username' => $validated_data['username']]);
            auth()->user()->customer->update(['customer_phone' => $validated_data['nohp']]);
    
            return redirect()->route('profile-user')->with('success','Berhasil Mengubah Data');
        }

    }
}
