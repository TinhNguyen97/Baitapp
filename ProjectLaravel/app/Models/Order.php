<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class Order extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'address',
        'email',
        'phone',
        'note'
    ];
    public function orderStatuses()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }
    public function orderCoupons()
    {
        return $this->hasMany(OrderCoupon::class);
    }
}
