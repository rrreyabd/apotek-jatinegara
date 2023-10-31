<?php

use App\Http\Controllers\GoogleController;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/test', function () {
    $user_id = User::where('role', 'user')->pluck('user_id')->all();
        $hasil = [];

        foreach ($user_id as $id) {
            $factory = [
                'customer_id' => fake()->uuid,
                'user_id' => $id,
                'cashier_phone' => fake()->phoneNumber(),
            ];
            $hasil[] = $factory;
        }
    return $hasil;
});

Route::controller(GoogleController::class)->group(function() {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.goole');
    Route::get('auth/google/callback','handleGoogleCallback');
});

Route::middleware(['auth', 'verified', 'cekRole:user'])->group(function () {
    Route::get('/', function () {
        return view('user.index');
    });
    
});

Route::middleware(['auth', 'verified', 'cekRole:cashier'])->group(function () {
    Route::get('/cashier', function () {
        return view('kasir.index');
    });
    
});

Route::middleware(['auth', 'verified', 'cekRole:owner'])->group(function () {
    Route::get('/owner', function () {
        return view('pemilik.index');
    });
    
});

require __DIR__.'/auth.php';
