<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{ 

    protected $table = 'authorities';
    public $timestamps = false;
    protected $fillable = ['userId', 'addProduct', 'updateProduct', 'accessReports'];
}
