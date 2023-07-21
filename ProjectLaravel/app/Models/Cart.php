<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use stdClass;

class Cart extends Model
{
    use HasFactory;
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($item, $id)
    {
        $cart = ['qty' => 0, 'price' => $item->unit_price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $cart = $this->items[$id];
            }
        }
        $cart['qty']++;

        if ($item->promotion_price == 0) {
            $cart['price'] = $item->unit_price * $cart['qty'];
            $this->items[$id] = $cart;
            $this->totalQty++;
            $this->totalPrice += $item->unit_price;
        } else {
            $cart['price'] = $item->promotion_price * $cart['qty'];
            $this->items[$id] = $cart;
            $this->totalQty++;
            $this->totalPrice += $item->promotion_price;
        }
    }
    //xóa 1
    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }
    //xóa nhiều
    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
