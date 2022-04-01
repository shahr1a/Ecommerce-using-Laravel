<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

use Auth;

class OrderController extends Controller
{
    public function AllOrders() {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_all', compact('orders'));
    }

    public function PendingOrders() {
        $orders = Order::where('status', 'Pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_pending', compact('orders'));
    }

    public function OrderDetails($order_id) {
        $order = Order::with('state', 'district', 'division','user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('backend.orders.order_details', compact('order', 'orderItem'));
    }

    public function ConfirmedOrders() {
        $orders = Order::where('status', 'Confirmed')->orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_confirmed', compact('orders'));
    }

    public function ProcessingOrders() {
        $orders = Order::where('status', 'Processing')->orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_processing', compact('orders'));
    }

    public function PickedOrders() {
        $orders = Order::where('status', 'Picked')->orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_processing', compact('orders'));
    }

    public function ShippedOrders() {
        $orders = Order::where('status', 'Shipped')->orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_shipped', compact('orders'));
    }

    public function DeliveredOrders() {
        $orders = Order::where('status', 'Delivered')->orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_delivered', compact('orders'));
    }

    public function CanceledOrders() {
        $orders = Order::where('status', 'canceled')->orderBy('id', 'DESC')->get();
        return view('backend.orders.orders_canceled', compact('orders'));
    }

    public function PendingToConfirm($order_id) {
        Order::findOrFail($order_id)->update([
            'status' => 'Confirmed',
            'confirmed_date' => Carbon::now()->format('d F Y'),
        ]);

        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('orders-confirmed')->with($notification);
    
    }

    public function ConfirmedToProcessing($order_id) {
        Order::findOrFail($order_id)->update([
            'status' => 'Processing',
            'processing_date' => Carbon::now()->format('d F Y'),
        ]);

        $notification = array(
            'message' => 'Order Processing Started',
            'alert-type' => 'success'
        );
    
        return redirect()->route('orders-processing')->with($notification);
    
    }

    public function ProcessingToPicked($order_id) {
        Order::findOrFail($order_id)->update([
            'status' => 'Picked',
            'picked_date' => Carbon::now()->format('d F Y'),
        ]);

        $notification = array(
            'message' => 'Order Picked',
            'alert-type' => 'success'
        );
    
        return redirect()->route('orders-picked')->with($notification);
    
    }

    public function PickedToShipped($order_id) {
        Order::findOrFail($order_id)->update([
            'status' => 'Shipped',
            'shipped_date' => Carbon::now()->format('d F Y'),
        ]);

        $notification = array(
            'message' => 'Order Shipped Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('orders-shipped')->with($notification);
    
    }

    public function ShippedToDelivered($order_id) {
        Order::findOrFail($order_id)->update([
            'status' => 'Delivered',
            'delivery_date' => Carbon::now()->format('d F Y'),
        ]);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('orders-delivered')->with($notification);
    
    }

}
