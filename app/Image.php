<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'id',
        'name',
        'product_id',
        'active',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
