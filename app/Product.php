<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $table = 'products';


    protected $fillable = ['product_code', 'product_name', 'product_image', 'location_in_shelf', 'product_category', 'brand', 'price_to_be_sold', 'price_bought'];
}
