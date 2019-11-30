<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['product_code', 'number', 'invoice_id'];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }



}
