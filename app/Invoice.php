<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Sale;

class Invoice extends Model
{
    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function total(){
         $total = 0;
         foreach($this->sales as $sale){
             $product_price = $sale->product->price_to_be_sold;
             $product_number = $sale->number;
             $total += $product_number * $product_price;
         }
         return $total;
    }

    public static function thisDay(){
        $invoicesToday = Invoice::whereDate('created_at', Carbon::today())->get();
        return $invoicesToday;
    }

    public static function thisWeek(){
        //get all invoices this week
        $invoicesThisWeek = Invoice::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        //return the sales
        return $invoicesThisWeek;
    }

    public static function thisMonth(){
        $invoicesThisMonth = Invoice::where('created_at', '>=', Carbon::now()->startOfMonth())->get();
        return $invoicesThisMonth;
    }

    public static function thisYear(){
        $invoicesThisYear = Invoice::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        return $invoicesThisYear;
    }



}
