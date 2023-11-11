<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Group;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function home() {
        // last purcase
            if(Auth()->user()){
                $products_last_purcase = SellingInvoice::where('customer_id', Auth()->user()->user_id)->orderBy('order_date', 'desc')->get();

                
                if ($products_last_purcase->count() > 0) {
                    foreach($products_last_purcase as $product){
                        foreach($product->sellinginvoicedetail as $p){
                            $product_last_purcase[] = $p;
                        }
                    }

                    foreach(collect($product_last_purcase) as $p){
                        if(Product::where('product_name', $p->product_name)->where('product_stock', '>',  0)->first() != NULL){
                            $products[] = Product::where('product_name', $p->product_name)->get();
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
            // ubah jadi view
            $products_best_seller = SellingInvoiceDetail::select('product_name', DB::raw('COUNT(*) as jumlah_kemunculan'))
            ->groupBy('product_name')
            ->OrderBy('jumlah_kemunculan', 'DESC')
            ->get();

            if ($products_best_seller->count() > 0) {
                foreach($products_best_seller as $p){
                    if(Product::where('product_name', $p->product_name)->where('product_stock', '>',  0)->first() != NULL){
                        // echo(collect(Product::where('product_name', $p->product_name)->first()));
                        $product_best_seller[] = Product::where('product_name', $p->product_name)->get();
                    }
                }
            } else {
                $product_best_seller = NULL;
            }
        // akhir banyak dicari


        return view("user.index", [
            "title"=> "Apotek | Home",
            "categories"=> Category::orderBy('category')->get() ?? [],
            "products_last_purcase"=> collect($products ?? [])->take(5),
            "products_best_seller" => collect($product_best_seller ?? [])->take(5),
        ]);
    }
    
    public function produk(Request $request) {
        $categories = Category::orderBy('category')->get();
        $groups = Group::orderBy('group')->get();
        $units = Unit::orderBy('unit')->get();

        $all_product = Product::all();

        // filter kategori
        if ($request->kategori) {
            if (Category::where('category', $request->kategori)->first() != NULL) {
                // ubah menjadi view
                $product = Product::whereHas('detail.category', function ($query) use ($request) { 
                    $query->where('category', $request->kategori);
                });
            }else{
                $product = NULL;
            }
        }
        // akhir filter kategori

        // filter group
        if ($request->golongan) {
            if (Group::where('group', $request->golongan)->first() != NULL) {
                // ubah menjadi view
                if($request->kategori) {
                    $product = $product->whereHas('detail.group', function ($query) use ($request) {
                        $query->where('group', $request->golongan);
                    });
                }else{
                    $product = Product::whereHas('detail.group', function ($query) use ($request) { 
                        $query->where('group', $request->golongan);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter group

        // filter unit
        if ($request->bentuk) {
            if (Unit::where('unit', $request->bentuk)->first() != NULL) {
                // ubah menjadi view
                if($request->golongan) {
                    $product = $product->whereHas('detail.unit', function ($query) use ($request) {
                        $query->where('unit', $request->bentuk);
                    });
                }elseif($request->kategori){
                    $product = $product->whereHas('detail.unit', function ($query) use ($request) {
                        $query->where('unit', $request->bentuk);
                    });
                }else{
                    $product = Product::whereHas('detail.unit', function ($query) use ($request) { 
                        $query->where('unit', $request->bentuk);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter unit

        // filter harga
        if ($request->maksimum || $request->minimum) {
            if ($request->maksimum) {
                if($request->golongan || $request->kategori || $request->bentuk) {
                    $product = $product->where('product_sell_price', '<=', $request->maksimum);
                }else{
                    $product = Product::where('product_sell_price', '<=', $request->maksimum);
                }
            }
            
            if ($request->minimum){
                if($request->golongan || $request->kategori || $request->bentuk || $request->maksimum) {
                    $product = $product->where('product_sell_price', '>=', $request->minimum);
                }else{
                    $product = Product::where('product_sell_price', '>=', $request->minimum);
                }
            }
        }
        // akhir filter harga
            
        if(isset($product)) {
            $product = $product->paginate(9)->withQueryString();
        }else{
            $product = Product::paginate(9)->withQueryString();
        }
        

        return view("user.products", [
            "products"=> $product ?? NULL,
            "all_products" => $all_product ?? [],
            "categories"=> $categories ?? [],
            "units"=> $units ?? [],
            "groups"=> $groups ?? [],
        ]);
    }
}
