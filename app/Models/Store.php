<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';

    protected $fillable = ['name', 'description', 'price', 'img'];

    public function users()
    {
        // 1 - 1
        // return $this->hasOne(User::class, 'id', 'user_id');

        //1 - many
        return $this->hasMany(User::class, 'id', 'user_id');

        // //many - many
        // return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function scopeGet30bath($query)
    {
        return $query->where('price', '>', 30);
    }
}
