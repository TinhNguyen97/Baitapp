<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function index()
    {

        $countProducts = DB::select(
            "SELECT sum(quantity_sold) AS count FROM products
            WHERE updated_at
            BETWEEN
            (SELECT date_add(date_add(LAST_DAY(Now()),interval 1 DAY),interval -1 MONTH) AS first_day)
            AND
            (SELECT LAST_DAY(now()))"
        );

        $revenues = DB::select(
            "SELECT
            products.quantity_sold, products.promotion_price, products.unit_price, coupons.number
            FROM products JOIN order_details ON products.id = order_details.product_id
            JOIN orders on orders.id = order_details.order_id
            JOIN coupons on orders.coupon_id = coupons.id
            WHERE products.updated_at
            BETWEEN
            (SELECT date_add(date_add(LAST_DAY(Now()),interval 1 DAY),interval -1 MONTH) AS first_day)
            AND
            (SELECT LAST_DAY(now()))"
        );
        return view('statisticals.index', ['countProduct' => $countProducts[0], 'revenues' => $revenues]);
    }
}
