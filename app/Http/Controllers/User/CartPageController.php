<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Models\ShippingDivision;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;

use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function MyCart() {
        return view('frontend.cart.view_mycart');
    }

    public function GetCartProduct() {
        $carts = Cart::content();
        $totalItems = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'totalItems' => $totalItems,
            'cartTotal' => floatval(preg_replace("/[^-0-9\.]/","",$cartTotal))
        ));
    }

    public function UpdateCartCoupon() {
        if(Session::has('coupon')) {
            $subtotal = floatval(preg_replace("/[^-0-9\.]/","", Cart::total()));
            $discount_amount = round($subtotal * session()->get('coupon')['coupon_discount']/100);

            Session::put('coupon.discount_amount', $discount_amount);
            Session::put('coupon.total_amount', round($subtotal - $discount_amount));
        }
    }

    public function RemoveCartProduct($rowId) {
        Cart::remove($rowId);
        if(Cart::count() == 0) {
            if(Session::has('coupon')) {
                Session::forget('coupon');
            }
        }
        
        return response()->json(['success' => 'Item Removed From Cart']);
    }
    
    public function CartIncrement($rowId) {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty + 1);

        CartPageController::UpdateCartCoupon();

        return response()->json(['increment']);
    }

    public function CartDecrement($rowId) {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty - 1);

        CartPageController::UpdateCartCoupon();

        return response()->json('decrement');
    }

    public function CouponApply(Request $request) {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if($coupon) {
            $cartTotalPrice = floatval(preg_replace("/[^-0-9\.]/","", Cart::total()));
            $discount_amount = round($cartTotalPrice * $coupon->coupon_discount/100);
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discount_amount,
                'total_amount' => round($cartTotalPrice - $discount_amount)
            ]);

            return response()->json(array(
                'success' => 'Coupon Applied Successfully'
            ));
        } else {
            return response()->json(['error'=>'Invalid Coupon']);
        }
    }

    public function CouponCalculation(){
        if(Session::has('coupon')) {
            $subtotal = floatval(preg_replace("/[^-0-9\.]/","", Cart::total()));
            $discount_amount = round($subtotal * session()->get('coupon')['coupon_discount']/100);
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => $discount_amount,
                'total_amount' => round($subtotal - $discount_amount)
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total()
            ));
        }
    }

    public function CouponRemove() {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    ############## CHECKOUT ##############

    public function Checkout() {
        if(Auth::check()) {

            if(Cart::total() > 0) {

                $carts = Cart::content();
                $totalItems = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShippingDivision::orderBy('division_name', 'ASC')->get();

                return view('frontend.checkout.view_checkout', compact('carts', 'totalItems', 'cartTotal', 'divisions'));
            
            } else {
                $notification = array(
                    'message' => 'Add Atleast One Product',
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notification);
            }

        } else {
            $notification = array(
                'message' => 'Please Login to do checkout',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification);
        }
    }
}
