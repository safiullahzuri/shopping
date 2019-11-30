<?php

namespace App;

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

}
