<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use App\Http\Requests\StoreCashierRequest;
use App\Http\Requests\UpdateCashierRequest;
use App\Policies\SellingInvoiceDetailPolicy;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCashierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function riwayatTransaksi()
    {
        $histories = SellingInvoice::with('sellingInvoiceDetail')
            ->where('order_status', 'Berhasil')
            ->orWhere('order_status','Offline')
            ->orWhere('order_status','Gagal')
            ->orWhere('order_status','Refund')
            ->get();
        $histories = $histories->reverse();
            // dd($histories);
    
        return view('kasir.riwayat-transaksi', ['histories' => $histories]);
    }

    public function edit(Cashier $cashier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCashierRequest $request, Cashier $cashier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashier $cashier)
    {
        //
    }
}