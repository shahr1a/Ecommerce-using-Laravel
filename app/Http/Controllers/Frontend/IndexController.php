<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index() {
        $sliders = Slider::where('status', TRUE)->orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::where('status', TRUE)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        $featuredProducts = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $special_deals = Product::where('special_deal', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();
        
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();
        

        return view('frontend.index', compact('categories', 'sliders', 'products', 'featuredProducts', 'hot_deals', 'special_offer', 'special_deals', 'skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1'));
    }

    public function UserLogout() {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile() {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request) {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;

        if($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('dashboard')->with($notification);
    }

    public function UserChangePassword() {
        return view('frontend.profile.change_password');
    }

    
    public function UserPasswordUpdate(Request $request) {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
        
            return redirect()->route('user.logout');
        } else {
            $notification = array(
                'message' => 'Current password did not match! Failed updating password..',
                'alert-type' => 'warning'
            );
            return redirect()->route('change.password')->with($notification);
        }
    }

    public function ProductDetails($id, $slug) {
        $product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_bn = $product->product_color_bn;
        $product_color_bn = explode(',', $color_bn);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        $size_bn = $product->product_size_bn;
        $product_size_bn = explode(',', $size_bn);

        $multiImg = MultiImg::where('product_id', $id)->get();

        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();

        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.product.product_details', compact('product', 'multiImg', 'product_color_en', 'product_color_bn', 'product_size_en', 'product_size_bn', 'relatedProducts', 'hot_deals'));
    }

    public function TagWiseProduct($tag){
        $products = Product::where('status', TRUE)->where('product_tags_en', $tag)->
        where('product_tags_en', $tag)->orderBy('id', 'DESC')->paginate(3);

        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }

    public function ProductViewAjax($id) {
        
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color = explode(',', $color_en);

        $size_en = $product->product_size_en;
        $product_size = explode(',', $size_en);

        

        return response()->json(array(
            'product' => $product, 
            'color' => $product_color, 
            'size'=>$product_size
        ));
    }
}
