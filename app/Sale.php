<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['product_code', 'number', 'invoice_id'];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function product(){
        return $this->belongsTo(Product::class, "product_code", "product_code");
    }

    public static function today(){
        $invoicesToday = Invoice::thisDay();
        $sales = array();
        foreach ($invoicesToday as $invoice){
            array_push($sales, $invoice->sales);
        }
        return $sales;
    }

    public static function thisWeek(){
        $invoicesToday = Invoice::thisWeek();
        $sales = array();
        foreach ($invoicesToday as $invoice){
            array_push($sales, $invoice->sales);
        }
        return $sales;
    }

    public static function thisMonth(){
        $invoicesThisMonth = Invoice::thisMonth();
        $sales = array();
        foreach ($invoicesThisMonth as $invoice){
            array_push($sales, $invoice->sales);
        }
        return $sales;
    }

    public static function thisYear(){
        $invoicesThisYear = Invoice::thisYear();
        $sales = array();
        foreach ($invoicesThisYear as $invoice){
            array_push($sales, $invoice->sales);
        }
        return $sales;
    }





}
