<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function index(){
        return view("sales.index");
    }



    public function getProduct(Request $request){
        $product = Product::where('product_code', $request->barcode)->first();
        return response()->json($product);
    }

    public function getPrice(Request $request){
        $product = Product::where('product_code', $request->barcode)->first();
        return response()->json($product->price_to_be_sold);
    }

}
