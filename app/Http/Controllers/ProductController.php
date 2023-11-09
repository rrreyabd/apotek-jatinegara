<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function home() {
        // last purcase
            if(Auth()->user()){
                $products_last_purcase = SellingInvoice::where('customer_name', Auth()->user()->username)->orderBy('order_date', 'desc')->get();

                
                if ($products_last_purcase->count() > 0) {
                    foreach($products_last_purcase as $product){
                        foreach($product->sellinginvoicedetail as $p){
                            $product_last_purcase[] = $p;
                        }
                    }

                    foreach(collect($product_last_purcase) as $p){
                        if(Product::where('product_name', $p->product_name)->first() != NULL){
                            $products[] = Product::where('product_name', $p->product_name)->get();
                        }else{
                            $products = NULL;
                        }
                    }
                } else {
                    $products = NULL;
                }
            } else {
                $products = NULL;
            }
        // akhir last purcase

        // banyak dicari
            $products_best_seller = SellingInvoiceDetail::select('product_name', DB::raw('COUNT(*) as jumlah_kemunculan'))
            ->groupBy('product_name')
            ->OrderBy('jumlah_kemunculan', 'DESC')
            ->get();

            if ($products_best_seller->count() > 0) {
                foreach($products_best_seller as $p){
                    if(Product::where('product_name', $p->product_name)->first() != NULL){
                        $product_best_seller[] = Product::where('product_name', $p->product_name)->get();
                    }else{
                        $product_best_seller = NULL;
                    }
                }
            } else {
                $product_best_seller = NULL;
            }
        // akhir banyak dicari

        return view("user.index", [
            "title"=> "Apotek | Home",
            "categories"=> Category::orderBy('category')->get(),
            "products_last_purcase"=> collect($products)->take(5),
            "products_best_seller" => collect($product_best_seller)->take(5),
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
