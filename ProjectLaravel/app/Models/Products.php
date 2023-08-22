<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_id',
        'description',
        'unit_price',
        'promotion_price',
        'product_quantity',
        'quantity_sold',
        'image',
        'is_active'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
