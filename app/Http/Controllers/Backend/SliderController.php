<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    public function SliderView() {
        $sliders = Slider::latest()->get();
        dd($sliders);
        return $sliders;
        // return view('backend.slider.slider_view', compact('sliders'));
    }

    public function SliderStore(Request $request) {
        $request->validate([
            'slider_img' => 'required',
        ],
        [
            'slider_img.required' => 'Input a Slider Image',
        ]);

        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/sliders/'.$name_gen);
        $save_url = 'upload/sliders/'.$name_gen;

        Slider::insert([
            'slider_img' => $save_url,
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Slider Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SliderEdit($id) {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }

    public function SliderUpdate(Request $request) {
        $slider_id = $request->id;
        $old_img = $request->old_image;
        // dd($request);

        if($request->file('slider_img')) {    
            $image = $request->file('slider_img');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870,370)->save('upload/sliders/'.$name_gen);
            $save_url = 'upload/sliders/'.$name_gen;

            Slider::findOrFail($slider_id)->update([
                'slider_img' => $save_url,
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'info'
            );
            unlink($old_img);
            return redirect()->route('manage-slider')->with($notification);
        } else {
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Slider Updated Without Image Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage-slider')->with($notification);
        }
    }

    public function SliderDelete($id) {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sldier Deleted Successfully',
            'alert-type' => 'info'
        );
        unlink($img);
        return redirect()->back()->with($notification);
    }

    public function SliderInactive($id) {
        Slider::findOrFail($id)->update([
            'status' => FALSE
        ]);

        $notification = array(
            'message' => 'Slider Inactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SliderActive($id) {
        Slider::findOrFail($id)->update([
            'status' => TRUE
        ]);

        $notification = array(
            'message' => 'Slider Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
