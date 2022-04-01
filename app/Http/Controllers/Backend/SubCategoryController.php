<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function SubCategoryView() {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategories', 'categories'));
    }

    public function SubCategoryStore(Request $request) {
        $request->validate([
            'category_id' => "required",
            'subcategory_name_en' => 'required|string',
            'subcategory_name_bn' => 'required|string',
        ], 
        [
            'category_id.required' => 'Please Select Any Option!',
            'subcategory_name_en.required' => 'Give a Sub Category Name in English',
            'subcategory_name_bn.required' => 'Give a Sub Category Name in Bangla'
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_bn' => $request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_bn' => strtolower(str_replace(' ', '-', $request->subcategory_name_bn)),
        ]);

        $notification = array(
            'message' => 'SubCategory Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id) {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));
    }


    public function SubCategoryUpdate(Request $request) {
        $subcategory_id = $request->id;


        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_bn' => $request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_bn' => strtolower(str_replace(' ', '-', $request->subcategory_name_bn)),
        ]);
        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.subcategory')->with($notification);

    }

    public function SubCategoryDelete($id) {
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
