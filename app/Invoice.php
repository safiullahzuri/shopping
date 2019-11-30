<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sale;

class Invoice extends Model
{
    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function total(){
         $total = 0;
         $ms = array();
         foreach($this->sales as $sale){
            array_push($ms, $sale->product);
         }
         return $ms;
    }
}
