<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function CouponView() {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.view_coupon', compact('coupons'));
    }

    public function CouponStore(Request $request) {
        $request->validate([
            'coupon_name' => "required|string",
            'coupon_discount' => 'required|integer',
            'coupon_validity' => 'required',
        ], 
        [
            'coupon_name.required' => 'Coupon Name is Required',
            'coupon_discount.required' => 'Need Discount Amount',
            'coupon_discount.integer' => 'Must be a Number',
            'coupon_validity.required' => 'Coupon Validity Needed'
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CouponEdit($id) {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon', compact('coupon'));
    }

    public function CouponUpdate(Request $request) {
        $coupon_id = $request->id;


            Coupon::findOrFail($coupon_id)->update([
                'coupon_name' => strtoupper($request->coupon_name),
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Coupon Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage-coupon')->with($notification);

    }

    public function CouponDelete($id) {
        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function CouponInactive($id) {

            Coupon::findOrFail($id)->update([
                'status' => FALSE
            ]);
    
            $notification = array(
                'message' => 'Coupon Inactivated Successfully',
                'alert-type' => 'success'
            );
        
        return redirect()->back()->with($notification);
    }

    public function CouponActive($id) {
        $coupon = Coupon::findOrFail($id);
        if(Carbon::now()->format('Y-m-d') >= $coupon->coupon_validity) {
            Coupon::findOrFail($id)->update([
                'status' => FALSE
            ]);

            $notification = array(
                'message' => 'Unable to Activate the Coupon since the date is passed',
                'alert-type' => 'error'
            );
        } else {
            Coupon::findOrFail($id)->update([
                'status' => TRUE
            ]);
    
            $notification = array(
                'message' => 'Coupon Activated Successfully',
                'alert-type' => 'success'
            );
        }
        
        return redirect()->back()->with($notification);
    }
}
