<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersLine extends Model
{
    use HasFactory;

    protected $table = 'orders_line';

    protected $guarded = [];

    public function header()
    {
        return $this->belongsTo(OrdersHeader::class);
    }
}
