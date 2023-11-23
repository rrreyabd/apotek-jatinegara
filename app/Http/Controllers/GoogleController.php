<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver("google")->redirect();
    }

    public function handleGoogleCallback(){
        try{
            $user = Socialite::driver("google")->user();
            $finduser = User::where("google_id", $user->id)->orWhere('email', $user->email)->first();
            // @dd($finduser);

            if($finduser){
                if($finduser->google_id == NULL){
                    User::where('email', $user->email)->update(['google_id' => $user->id]);
                }

                Auth::login($finduser);
                return redirect("/");
            }else{
                $usernames = User::where('username', 'LIKE', 'u %')->orderBy('username', 'desc')->pluck('username')->first();
                $username = intval(str_replace("u ", "", $usernames)) + 1;

                $newUser = User::create([
                    'user_id' => Str::uuid(),
                    'username' => 'u '. str_pad($username, 1, '0', STR_PAD_LEFT),
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('123'),
                    'role' => 'user'
                ]);

                Customer::create([
                    'customer_id' => Str::uuid(),
                    'user_id' => User::where('role', 'user')->latest()->pluck('user_id')->first()
                ]);
                
                event(new Registered($newUser));
                Auth::login($newUser);
                return redirect('/');
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}