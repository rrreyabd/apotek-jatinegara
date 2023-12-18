<?php

namespace App\Http\Controllers;

use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile() {
        return view("user.profile-user",[
            "username"=> auth()->user()->username ?? "",
            "nomorhp"=> auth()->user()->customer->customer_phone ?? "",
            "email"=> auth()->user()->email ?? "",
        ]);
    }

    public function ubah(Request $request) {
        if ($request->update == 'profile') {

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
            User::on('user')->where('user_id', auth()->user()->user_id)->update(['username' => $validated_data['username']]);
            User::on('user')->where('user_id', auth()->user()->user_id)->first()->customer->update(['customer_phone' => $validated_data['nohp']]);
            
            return redirect()->route('profile-user')->with('success_profile','Berhasil Mengubah Data');
            }

        } else if($request->update == 'password'){

            if(Hash::check('123', auth()->user()->password)){
                $validated_data = $request->validate([
                    'password_baru' => 'required|min:8|regex:/^[^\s]+$/',
                    'konfirmasi_password_baru' => 'required|min:8|same:password_baru|regex:/^[^\s]+$/'
                ]);
            }else{
                $validated_data = $request->validate([
                    'password_lama' => 'required|min:8|regex:/^[^\s]+$/',
                    'password_baru' => 'required|min:8|regex:/^[^\s]+$/',
                    'konfirmasi_password_baru' => 'required|min:8|same:password_baru|regex:/^[^\s]+$/'
                ]);
            }

            if(Hash::check('123', auth()->user()->password)){
                    User::on('user')->where('user_id', auth()->user()->user_id)->update([
                        'password' => bcrypt($request->password_baru)
                    ]);
    
                    return redirect()->back()->with('success_password', 'Password Berhasil Diubah!!');
            }else{
                if (Hash::check($request->password_lama, auth()->user()->password)) {
                    User::on('user')->where('user_id', auth()->user()->user_id)->update([
                        'password' => bcrypt($request->password_baru)
                    ]);
    
                    return redirect()->back()->with('success_password', 'Password Berhasil Diubah!!');
                }
            }

            return redirect()->back()->with('error', 'Konfirmasi Password Lama Salah!!');
        }
    }

    public function hapus(Request $request): RedirectResponse{
        $username = Auth()->user()->username;

        Auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        User::on('user')->where('username', $username)->delete();

        return redirect('/');
    }

    public function riwayatTransaksi(Request $request) {

        $products_purcase = SellingInvoice::on('user')->where('customer_id', Auth()->user()->user_id)->orderBy('order_date', 'desc');

        if($request->status) {
            $products_purcase = $products_purcase->where('order_status', $request->status);
        }
        
        if($request->cari) {
            $products_purcase = $products_purcase->where('invoice_code', 'like', '%'.$request->cari.'%');
        }

        $products_purcase = $products_purcase->paginate(5)->withQueryString();

        $status = SellingInvoice::on('user')->where('customer_id', Auth()->user()->user_id)->distinct()->pluck('order_status');

        return view('user.riwayat-pesanan', [
            'products_purcase' => $products_purcase,
            'status'=> $status ?? [],
        ]);
    }

    public function detailRiwayatTransaksi(Request $request) {
        $purcase = SellingInvoice::on('user')->where('selling_invoice_id', $request->pesanan)->first();

        $detail_products = SellingInvoiceDetail::on('user')->where('selling_invoice_id', $request->pesanan)->get();
        
        if($request->pesanan && $purcase->first() != NULL) {
            return view('user.detail-riwayat-pesanan', [
                'purcase'=> $purcase,
                'detail_products'=> $detail_products,
            ]);
        }else{
            abort(404);
        }
    }
}