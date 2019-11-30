<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $primaryKey = "product_id";


    protected $fillable = ['product_code', 'product_name', 'product_image', 'location_in_shelf', 'product_category', 'brand', 'price_to_be_sold', 'price_bought'];


    public function decreaseBy($number){
        $existingProducts = $this->existingNumber;
        if ($existingProducts > $number){
            $existingProducts -= $number;
        }
        $this->existingNumber = $existingProducts;
        if ($this->save()){
            return true;
        }else{
            return false;
        }
    }

    public static function thisDay(){
        $productsToday = Product::whereDate('created_at', Carbon::today())->get();
        return $productsToday;
    }

    public static function thisWeek(){
        $productsThisWeek = Product::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return $productsThisWeek;
    }

    public static function thisMonth(){
        $productsThisMonth = Product::where('created_at', '>=', Carbon::now()->startOfMonth())->get();
        return $productsThisMonth;
    }

    public static function thisYear(){
        $productsThisYear = Product::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        return $productsThisYear;
    }

}
