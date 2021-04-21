<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function employee(){
        return $this->belongsTo(User::class);
    }
}
