<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\TypeProduct;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Comment\CommentService;
use App\Services\Comment\CommentServiceInterface;
use App\Services\Coupon\CouponService;
use App\Services\Coupon\CouponServiceInterface;
use App\Services\Info\InfoService;
use App\Services\Info\InfoServiceInterface;
use App\Services\Notification\NotificationService;
use App\Services\Notification\NotificationServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailService;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Slide\SlideService;
use App\Services\Slide\SlideServiceInterface;
use App\Services\TypeProduct\TypeProductService;
use App\Services\TypeProduct\TypeProductServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
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
        //Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        //ProductService
        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );
        $this->app->singleton(
            SlideServiceInterface::class,
            SlideService::class
        );
        $this->app->singleton(
            TypeProductServiceInterface::class,
            TypeProductService::class
        );
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );
        $this->app->singleton(
            InfoServiceInterface::class,
            InfoService::class
        );
        $this->app->singleton(
            CouponServiceInterface::class,
            CouponService::class
        );
        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );
        $this->app->singleton(
            OrderDetailServiceInterface::class,
            OrderDetailService::class
        );
        $this->app->singleton(
            NotificationServiceInterface::class,
            NotificationService::class
        );
        $this->app->singleton(
            CommentServiceInterface::class,
            CommentService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        view()->composer('home.header', function ($view) {
            $allTypes = TypeProduct::all();

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
