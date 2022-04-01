<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class FProductController extends Controller
{
    public function SubCatWiseProduct($id, $slug) {
        $products = Product::where('status', TRUE)->where('subcategory_id', $id)->orderBy('id', 'DESC')->paginate(6);

        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('frontend.product.subcategory_view', compact('products', 'categories'));
    }

    public function SubSubCatWiseProduct($id, $slug) {
        $products = Product::where('status', TRUE)->where('subsubcategory_id', $id)->orderBy('id', 'DESC')->paginate(6);

        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('frontend.product.sub_subcategory_view', compact('products', 'categories'));
    }
}
