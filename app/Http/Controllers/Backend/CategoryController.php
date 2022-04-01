<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView() {
        $categories = Category::latest()->get();

        return view('backend.category.category_view', compact('categories'));
    }

    public function CategoryStore(Request $request) {
        $request->validate([
            'category_name_en' => "required|string",
            'category_name_bn' => 'required|string',
            'category_icon' => 'required|string',
        ], 
        [
            'category_name_en.required' => 'Give a Category Name in English',
            'category_name_bn.required' => 'Give a Category Name in Bangla',
            'category_icon.required' => 'Category Icon Required'
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_bn' => $request->category_name_bn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_bn' => strtolower(str_replace(' ', '-', $request->category_name_bn)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CategoryEdit($id) {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }


    public function CategoryUpdate(Request $request) {
        $category_id = $request->id;


            Category::findOrFail($category_id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_bn' => strtolower(str_replace(' ', '-', $request->category_name_bn)),
                'category_icon' => $request->category_icon,
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.category')->with($notification);

    }

    public function CategoryDelete($id) {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
