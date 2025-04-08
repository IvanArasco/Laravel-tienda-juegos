<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'price'];

    public function games()
    {
        return $this->belongsToMany(Game::class)->withPivot('quantity', 'price');
    }
}
