<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver',
        'user_id',
        'order_place',
        'order_phone',
        'order_time',
        'order_email',
        'status',
        'total',
        'note',
    ];

    protected $table = 'orders';

    protected $dates = ['deleted_at'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
