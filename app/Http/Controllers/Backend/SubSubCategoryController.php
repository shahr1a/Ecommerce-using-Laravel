<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;

class SubSubCategoryController extends Controller
{
    public function SubSubCategoryView() {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }

    public function GetSubCategory($category_id) {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    }

    public function GetSubSubCategory($subcategory_id) {
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcat);
    }

    public function SubSubCategoryStore(Request $request) {
        $request->validate([
            'category_id' => "required",
            'subcategory_id' => "required",
            'subsubcategory_name_en' => 'required|string',
            'subsubcategory_name_bn' => 'required|string',
        ], 
        [
            'category_id.required' => 'Please Select Any Option!',
            'subcategory_id.required' => 'Please Select Any Option!',
            'subsubcategory_name_en.required' => 'Give a Sub Category Name in English',
            'subsubcategory_name_bn.required' => 'Give a Sub Category Name in Bangla'
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_bn' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_bn)),
        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id) {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit', compact('subsubcategory', 'categories', 'subcategories'));
    }


    public function SubSubCategoryUpdate(Request $request) {
        $subsubcategory_id = $request->id;


        SubSubCategory::findOrFail($subsubcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_bn' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_bn)),
        ]);
        $notification = array(
            'message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.subsubcategory')->with($notification);

    }

    public function SubSubCategoryDelete($id) {
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
