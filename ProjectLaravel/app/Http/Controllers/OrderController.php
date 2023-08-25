<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailCancel;
use App\Jobs\SendEmailDelivering;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use App\Models\Statistical;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\Statistical\StatisticalServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    private $orderService;
    private $orderDetailService;
    private $productService;
    private $statisticalService;
    public function __construct(
        OrderServiceInterface $orderService,
        OrderDetailServiceInterface $orderDetailService,
        ProductServiceInterface $productService,
        StatisticalServiceInterface $statisticalService
    ) {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->productService = $productService;
        $this->statisticalService = $statisticalService;
    }
    public function index()
    {
        $orders = $this->orderService->findAllOrderByStatus(1);
        return view('orders.index', ['orders' => $orders]);
    }
    public function orderDetails($orderId)
    {

        $details = $this->orderDetailService->findCustomJoinByOrderId($orderId)->paginate(5);
        return view('orders.orderdetail', ['details' => $details]);
    }
    public function search(Request $request)
    {
        // DB::enableQueryLog();
        $allOrders = $this->orderService->search($request);
        // dd(DB::getQueryLog());
        return view('orders.search', [
            'allOrders' => $allOrders,
            'request' => $request,
        ]);
    }

    public function handleApprove($id)
    {
        $orderDetails = $this->orderDetailService->findAllByOrderId($id);
        $listProductNameError = '';
        foreach ($orderDetails as $key => $item) {
            $error = false;
            $product = $this->productService->find($item->product_id);
            if ($product->product_quantity < $item->quantity) {
                $error = true;
                $listProductNameError .= $product->name . ', ';
            }
            if ($key == count($orderDetails) - 1) {
                $listProductNameError = rtrim($listProductNameError, ', ');
            }
            if ($error == false) {
                $product->update([
                    'product_quantity' => $product->product_quantity - $item->quantity,
                    'quantity_sold' => $product->quantity_sold + $item->quantity
                ]);
            }
        };
        if ($error == true) {
            return back()->with(['overqty' => 'Số lượng hàng còn lại ít hơn số lượng hàng đặt', 'productname' => $listProductNameError]);
        }
        $this->orderService->update(['order_status_id' => 2], $id);
        $emailTo = $this->orderService->find($id)->email;
        SendEmailDelivering::dispatch($emailTo);


        //handle table statistical
        $countProduct = 0;
        $countRevenue = 0;
        $details = $this->orderDetailService->findCustomJoinByOrderId($id)->get();
        foreach ($details as $key => $item) {
            $countProduct += $item->quantity;
            if ($item->promotion_price < $item->unit_price) {
                $countRevenue += $item->promotion_price * $item->quantity * (1 - $item->number / 100);
            } else {
                $countRevenue += $item->unit_price * $item->quantity * (1 - $item->number / 100);
            }
        }
        $monthYear = date('m/Y');
        // dd(date("Y-m-d H:i:s"));
        $statistical = $this->statisticalService->findByMonthYear($monthYear);
        if (!$statistical) {
            $this->statisticalService->create([
                'month_year' => $monthYear,
                'count_product' => $countProduct,
                'count_revenue' => $countRevenue,
            ]);
        } else {
            $statistical->update([
                'count_product' =>  $statistical->count_product += $countProduct,
                'count_revenue' => $statistical->count_revenue += $countRevenue
            ]);
        }


        return back()->with(['successApprove' => true]);
    }
    public function history()
    {
        $orders = $this->orderService->findAllOrderByStatus(2);
        return view('orders.history', ['orders' => $orders]);
    }
    public function handleCancel($id)
    {
        $this->orderService->update(['order_status_id' => 3], $id);
        $emailTo = $this->orderService->find($id)->email;
        SendEmailCancel::dispatch($emailTo);
        return back()->with(['successCancel' => true]);
    }
    public function orderCancel()
    {
        $orders = $this->orderService->findAllOrderByStatus(3);
        return view('orders.cancel', ['orders' => $orders]);
    }

    public function searchOrderCancel(Request $request)
    {

        $allOrders = $this->orderService->searchWithKeyAndStatus($request, 3);
        return view('orders.searchordercancel', [
            'allOrders' => $allOrders,
            'request' => $request,
        ]);
    }
    public function searchHistory(Request $request)
    {
        // dd(1);
        $allOrders = $this->orderService->searchWithKeyAndStatus($request, 2);
        return view('orders.searchhistory', [
            'allOrders' => $allOrders,
            'request' => $request,
        ]);
    }
}
