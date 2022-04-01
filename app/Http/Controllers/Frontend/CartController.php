<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id) {
        $product = Product::findOrFail($id);
        
        if($product->discount_price == NULL) {
            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $request->quantity, 
                'price' => $product->selling_price, 
                'weight' => 1, 
                'options' => [
                    'image'=>$product->product_thumbnail, 
                    'color' => $request->color, 
                    'size' => $request->size,
                    ] 
                ]);

            return response()->json(['success'=>'Successfully Added on Your Cart']);
        } else {
            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $request->quantity, 
                'price' => $product->discount_price, 
                'weight' => 1, 
                'options' => [
                    'image'=>$product->product_thumbnail, 
                    'color' => $request->color, 
                    'size' => $request->size,
                    ] 
                ]);
            return response()->json(['success'=>'Successfully Added on Your Cart']);
        }
    }

    public function MiniCart(){
        $cartContents = Cart::content();
        $totalItems = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $cartContents,
            'totalItems' => $totalItems,
            'cartTotal' => floatval(preg_replace("/[^-0-9\.]/","",$cartTotal))
        ));
    }

    public function RemoveMiniCartItem($rowId) {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed From Cart']);
    }


}
