<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShippingDistrict;
use App\Models\ShippingState;

use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function GetDistrictsAjax($division_id){
        $districts = ShippingDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($districts);
    }
    public function GetStatesAjax($district_id){
        $states = ShippingState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return json_encode($states);
    }

    public function CheckoutStore(Request $request) {
        // dd($request->all());

        $data = array();

        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

        if($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        } elseif($request->payment_method == 'card') {
            return view('frontend.payment.card', compact('data'));
        } else {
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }
    } 
}
