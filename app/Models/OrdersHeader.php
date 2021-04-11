<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersHeader extends Model
{
    use HasFactory;

    protected $table = 'orders_header';

    protected $guarded = [];

    public function lines()
    {
        return $this->hasMany(OrdersLine::class, 'id', 'order_header');
    }
}
