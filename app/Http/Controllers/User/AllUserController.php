<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use PDF;

use Auth;

use App\Mail\OrderMail;


class AllUserController extends Controller
{
    public function MyOrders() {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('frontend.profile.order.order_view', compact('orders'));
    }

    public function OrderDetails($order_id) {
        $order = Order::with('state', 'district', 'division')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('frontend.profile.order.order_details', compact('order', 'orderItem'));
    }

    public function Invoice($order_id) {
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('frontend.profile.order.order_invoice2', compact('order', 'orderItem'));

        // $pdf = PDF::loadView('frontend.profile.order.order_invoice2', compact('order', 'orderItem'));
        // return $pdf->download('invoice.pdf'); 

    }
}
