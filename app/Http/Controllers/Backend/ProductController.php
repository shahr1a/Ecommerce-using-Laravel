<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;


class ProductController extends Controller
{
    public function AddProduct() {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function StoreProduct(Request $request) {
        $validatedData = $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name_en' => 'required|unique:products|max:255',
            'product_name_bn' => 'required|unique:products|max:255',
            'product_code' => 'required|unique:products',
            'product_qty' => 'required',
            'product_thumbnail' => 'required',
            'multi_img' => 'required'
        ],
        [
            'product_name_en.required' => 'You must input a product name',
            'product_name_en.unique' => 'Already Exist',
            'product_name_bn.unique' => 'Already Exist',
            'product_name_bn.required' => 'You must input a product name',
            'product_code.required' => 'Product Must have a code',
            'product_code.unique' => 'Product Code already Exist',
            'product_thumbnail.required' => 'Product Must have a Thumbnail',
        ]);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnails/'.$name_gen);
        $save_url = 'upload/products/thumbnails/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_bn' => strtolower(str_replace(' ', '-', $request->product_name_bn)),
            'product_name_bn' => $request->product_name_bn,

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deal' => $request->special_deal,

            'product_thumbnail' => $save_url,
            'status' => TRUE,
            'created_at' => Carbon::now(),
        ]);


        ////////// Multiple Image Upload ///////////
        
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $upload_path = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function ManageProduct() {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function EditProduct($id) {

        $multiImages = MultiImg::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();

        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('product', 'categories', 'brands', 'subcategories', 'subsubcategories', 'multiImages'));
    }

    public function ProductDataUpdate(Request $request) {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_bn' => strtolower(str_replace(' ', '-', $request->product_name_bn)),
            'product_name_bn' => $request->product_name_bn,

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deal' => $request->special_deal,

            'status' => TRUE,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Data Updated without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function MultiImageUpdate(Request $request) {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $upload_path = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $upload_path,
                'updated_at' => Carbon::now(),
            ]);
        } // End Foreach

        $notification = array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function ThumbnailImageUpdate(Request $request) {
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnails/'.$name_gen);
        $save_url = 'upload/products/thumbnails/'.$name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Image Thumbnail Updated Successfully',
            'alert-type' => 'info'
        );

        unlink($oldImage);

        return redirect()->back()->with($notification);
    }

    public function MultiImageDelete($id) {
        $oldImg = MultiImg::findOrFail($id);

        MultiImg::findOrFail($id)->delete();

        unlink($oldImg->photo_name);

        $notification = array(
            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductInactive($id) {
        Product::findOrFail($id)->update([
            'status' => FALSE
        ]);

        $notification = array(
            'message' => 'Product Inactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductActive($id) {
        Product::findOrFail($id)->update([
            'status' => TRUE
        ]);

        $notification = array(
            'message' => 'Product Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id) {
        $product = Product::findOrFail($id);

        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();

        foreach($images as $img) {           
            MultiImg::where('product_id', $id)->delete();
            unlink($img->photo_name);
        }

        unlink($product->product_thumbnail);

        $notification = array(
            'message' => 'Product Removed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
