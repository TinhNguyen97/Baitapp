<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
