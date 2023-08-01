<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\TypeProducts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        view()->composer('home.header', function ($view) {
            $allTypes = TypeProducts::all();

            $view->with(
                'allTypes',
                $allTypes
            );
        });
        view()->composer('home.header', function ($view) {
            if (Session('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with([
                    'cart' => Session::get('cart'),
                    'product_cart' => $cart->items,
                    'totalPrice' => $cart->totalPrice,
                    'totalQty' => $cart->totalQty
                ]);
            }
        });
        view()->composer('admin.sidebar', function ($view) {
            if (Auth::check()) {
                $view->with([
                    'fullName' => Auth::user()->full_name
                ]);
            }
        });
        view()->composer('admin.navbar', function ($view) {
            $total = DB::table('notifications')->join('users', 'users.id', '=', 'notifications.user_id')
                ->selectRaw('count(notifications.id) as total')->first()->total;
            $notifications = DB::table('notifications')->join('users', 'users.id', '=', 'notifications.user_id')
                ->selectRaw('notifications.*, users.full_name')->get();
            // dd($notifications);
            $view->with([
                'total' => $total,
                'notifications' => $notifications
            ]);
        });
    }
}
