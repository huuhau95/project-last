<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    protected $table = 'potentials';

    protected $fillable = [
        'id',
        'discount',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
