<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SellingInvoice;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCashierRequest;
use App\Http\Requests\UpdateCashierRequest;
use App\Policies\SellingInvoiceDetailPolicy;

class OwnerController extends Controller
{
    public function lihatKasir(){

        $cashiers = User::where('role', 'cashier')
        ->get();

        // dd($cashiers);
        return view ('pemilik.list-kasir', ['cashiers' => $cashiers]);
    }
    public function pendingOrder()
    {
        $pendingOrders = SellingInvoice::where('order_status', 'Menunggu Pengembalian')
            ->orderBy('order_date', 'desc')
            ->get();
            // dd($pendingOrders);

            $total = SellingInvoice::where('order_status', 'Menunggu Pengembalian')
            ->count();
    
        return view('pemilik.pesanan-pending', ['pendingOrders' => $pendingOrders,  'total' => $total]);
    }
    
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}