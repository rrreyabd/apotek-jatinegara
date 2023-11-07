<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\SellingInvoice;

class ProductController extends Controller
{
    public function home() {
        if(Auth()->user()){
            $products_last_purcase = SellingInvoice::where('customer_name', Auth()->user()->username)->orderBy('order_date', 'desc')->get();
            foreach($products_last_purcase as $product){
                foreach($product->sellinginvoicedetail as $p){
                    $product_last_purcase[] = $p;
                }
            }
        } else {
            $product_last_purcase = NULL;
        }

        return view("user.index", [
            "title"=> "Apotek | Home",
            "categories"=> Category::orderBy('category')->get(),
            "product_last_purcase"=> collect($product_last_purcase)->take(5),
        ]);
    }
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
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
