<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
	use SoftDeletes;

    protected $table = 'sizes';

    protected $fillable = [
        'id',
        'name',
        'percent',
    ];

    protected $dates = ['deleted_at'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
