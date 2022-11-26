<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function items(){
        return $this->hasMany(SupplierItems::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function orderHistory(){
        return $this->hasManyThrough(OrderEstimatedDates::class , Order::class);
    }
}
