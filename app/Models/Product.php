<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'quantity',
        'price',
        'promotional',
        'category_id',
        'producttype_id',
        'status',
        'image'
    ];

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType','producttype_id','id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category','category_id', 'id');
    }
}
