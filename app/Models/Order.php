<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id' , 'total_price' , 'menu_item_id', ];

    const SHIPPED = "SHIPPED";
    const ONWAY = "ONWAY";
    const DELIVERED = "DELIVERED";
    const STATUSES = [self::SHIPPED , self::ONWAY , self::DELIVERED   ];



    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function menuItem (){
        return $this->belongsTo(MenuItems::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function orderHistory(){
        return $this->hasMany(OrderEstimatedDates::class);
    }

}
