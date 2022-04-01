<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShippingDivision;
use App\Models\ShippingDistrict;
use App\Models\ShippingState;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    ######### Division Start ##########

    public function DivisionView() {
        $divisions = ShippingDivision::orderBy('id', 'DESC')->get();
        return view('backend.shipping.division.view_division', compact('divisions'));
    }

    public function DivisionStore(Request $request) {
        $request->validate([
            'division_name' => "required|string",
        ], 
        [
            'division_name.required' => 'Division Name is Required',
        ]);

        ShippingDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Division Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DivisionEdit($id) {
        $division = ShippingDivision::findOrFail($id);
        return view('backend.shipping.division.edit_division', compact('division'));
    }

    public function DivisionUpdate(Request $request) {
        $division_id = $request->id;


        ShippingDivision::findOrFail($division_id)->update([
                'division_name' => $request->division_name,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Division Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage-division')->with($notification);

    }

    public function DivisionDelete($id) {
        ShippingDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    ############## Division End ##############


       ######### District Start ##########

       public function DistrictView() {
        $divisions = ShippingDivision::latest()->get();
        $districts = ShippingDistrict::with('division')->orderBy('id', 'DESC')->get();
        return view('backend.shipping.district.view_district', compact('districts', 'divisions'));
    }

    public function DistrictStore(Request $request) {
        $request->validate([
            'division_id' => "required",
            'district_name' => "required|string",
        ], 
        [
            'division_id.required' => "Division is Required",
            'district_name.required' => 'District Name is Required',
        ]);

        ShippingDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'District Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DistrictEdit($id) {
        $district = ShippingDistrict::with('division')->findOrFail($id);
        $divisions = ShippingDivision::latest()->get();
        return view('backend.shipping.district.edit_district', compact('divisions', 'district'));
    }

    public function DistrictUpdate(Request $request) {
        $district_id = $request->id;


        ShippingDistrict::findOrFail($district_id)->update([
                'division_id' => $request->division_id,
                'district_name' => $request->district_name,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'District Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage-district')->with($notification);

    }

    public function DistrictDelete($id) {
        ShippingDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    ############## District End ##############


    ######### State Start ##########

    public function StateView() {
        $states = ShippingState::with('division')->with('district')->latest()->get();
        $divisions = ShippingDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.shipping.state.view_state', compact('divisions', 'states'));
    }

    public function GetDistrictsAjax($division_id){
        $districts = ShippingDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($districts);
    }

    public function StateStore(Request $request) {
        $request->validate([
            'division_id' => "required",
            'district_id' => "required",
            'state_name' => "required|string",
        ], 
        [
            'division_id.required' => "Division is Required",
            'district_id.required' => "District is Required",
            'state_name.required' => 'State Name is Required',
        ]);

        ShippingState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'State Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function StateEdit($id) {
        $state = ShippingState::with('division')->with('district')->findOrFail($id);
        $divisions = ShippingDivision::latest()->get();
        $districts = ShippingDistrict::where('division_id', $state->division_id)->orderBy('district_name', 'ASC')->get();
        return view('backend.shipping.state.edit_state', compact('divisions', 'state', 'districts'));
    }

    public function StateUpdate(Request $request) {
        $state_id = $request->id;


        ShippingState::findOrFail($state_id)->update([
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_name' => $request->state_name,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'State Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage-state')->with($notification);

    }

    public function StateDelete($id) {
        ShippingState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    ############## State End ##############
}
