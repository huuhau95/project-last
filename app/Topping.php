<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topping extends Model
{
	use SoftDeletes;

    protected $table = 'toppings';

    protected $fillable = [
        'id',
        'name',
        'price',
        'quantity',
    ];

    protected $dates = ['deleted_at'];

    public function orderDetails()
    {
        return $this->belongsToMany(OrderDetail::class)->withPivot('topping_price');;
    }
}
