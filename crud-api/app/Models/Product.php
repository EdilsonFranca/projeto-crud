<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $table ='products';
    public $timestamps=true;
    protected $fillable = array('name','price','description');
}
