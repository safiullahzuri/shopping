<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{


    public function index(){
        $invoices = Invoice::all();
        return view("invoice.index")->with("invoices", $invoices)
            ->with("invoicesToday", Invoice::thisDay())
            ->with("invoicesThisWeek", Invoice::thisWeek())
            ->with("invoicesThisMonth", Invoice::thisMonth())
            ->with("invoicesThisYear", Invoice::thisYear());
    }

    public function today(){
        $invoices = Invoice::thisDay();
        return view("invoice.thisDay")->with("invoices", $invoices);
    }

    public function thisWeek(){
        $invoices = Invoice::thisWeek();
        return view("invoice.thisWeek")->with("invoices", $invoices);
    }

    public function thisMonth(){
        $invoices = Invoice::thisMonth();
        return view("invoice.thisMonth")->with("invoices", $invoices);
    }

    public function thisYear(){
        $invoices = Invoice::thisYear();
        return view("invoice.thisYear")->with("invoices", $invoices);
    }

    public function show($id){
        $invoice = Invoice::find($id);
        return view('invoice.show')->with('invoice', $invoice);
    }


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
