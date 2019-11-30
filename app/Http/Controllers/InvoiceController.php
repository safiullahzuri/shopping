<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use App\Sale;
use http\Env\Response;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function storeInvoice(Request $request){
        $numbers = $request->numbers;
        $barcodes = $request->barcodes;
        $data = array();
        $invoice = new Invoice();

        if ($invoice->save()){
            $invoice_id = $invoice->id;
            if (sizeof($numbers) === sizeof($barcodes)){
                for($i=0; $i<sizeof($numbers); $i++){

                    //decrease the number of products in the products table
                    //Product::decreaseBy($barcodes[$i], $numbers[$i]);
                    $product = Product::where("product_code",$barcodes[$i])->first();
                    $product->decreaseBy($numbers[$i]);

                    array_push($data, array("product_code" => $barcodes[$i], "number" => $numbers[$i], "invoice_id" => $invoice_id));
                }
            }
            Sale::insert($data);
            return response()->json(["msg"=>"success"], 200);
        }

    }
}
