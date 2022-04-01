<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController; 
use App\Http\Controllers\Backend\ShippingAreaController; 
use App\Http\Controllers\Backend\OrderController; 

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\FProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\AllUserController;
use App\Models\User;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::group(['prefix'=> 'admin', 'middleware' => ['admin:admin']], function(){
//     Route::get('/login', [AdminController::class, 'loginForm']);
//     Route::post('/login',[AdminController::Class, 'store'])->name('admin.login');
// });



// Admin All Routes

// Route::middleware(['auth:admin'])->group(function(){
//     Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function(){
//         return view('admin.index');
//     })->name('dashboard');

//     Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
//     Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
//     Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
//     Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
//     Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
//     Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
// });



// // User All Routes

// Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function(){
//     $id = Auth::user()->id;
//     $user = User::find($id);
//     return view('dashboard', compact('user'));
// })->name('dashboard');

// Route::get('/', [IndexController::class, 'index']);
// Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
// Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
// Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
// Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
// Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');


// // Admin Brand All Routes

// Route::middleware(['auth:admin'])->prefix('brand')->group(function(){
//     Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');

//     Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');

//     Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');

//     Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');

//     Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');

// });

// // Admin Category All Routes

// Route::middleware(['auth:admin'])->prefix('category')->group(function(){
//     Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');

//     Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

//     Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');

//     Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');

//     Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

//     // Admin Sub Category All Routes

//     Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

//     Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

//     Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

//     Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

//     Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

//     // Admin Sub->Sub Category All Routes

//     Route::get('/sub/sub/view', [SubSubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

//     Route::get('/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);

//     Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);

//     Route::post('/sub/sub/store', [SubSubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

//     Route::get('/sub/sub/edit/{id}', [SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

//     Route::post('/sub/sub/update', [SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

//     Route::get('/sub/sub/delete/{id}', [SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
// });


// // Admin Products All Routes

// Route::middleware(['auth:admin'])->prefix('product')->group(function(){
//     Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    
//     Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');

//     Route::post('/store', [ProductController::class, 'StoreProduct'])->name('store-product');

//     Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');

//     Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');

//     Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    
//     Route::post('/thumbnail/update', [ProductController::class, 'ThumbnailImageUpdate'])->name('update-product-thumbnail');

//     Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');

//     Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');

//     Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

//     Route::get('/delete/{id}', [ProductController::class, 'DeleteProduct'])->name('product.delete');
// });


// // Admin Slider All Routes
// Route::middleware(['auth:admin'])->prefix('slider')->group(function(){
//     Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');

//     Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');

//     Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');

//     Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');

//     Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');

//     Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');

//     Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
// });

// // Admin Coupon All Routes
// Route::middleware(['auth:admin'])->prefix('coupons')->group(function(){
//     Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');

//     Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');

//     Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');

//     Route::post('/update', [CouponController::class, 'CouponUpdate'])->name('coupon.update');

//     Route::get('/inactive/{id}', [CouponController::class, 'CouponInactive'])->name('coupon.inactive');

//     Route::get('/active/{id}', [CouponController::class, 'CouponActive'])->name('coupon.active');

//     Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
// });

// // Admin Order All Routes
// Route::middleware(['auth:admin'])->prefix('admin/orders')->group(function(){
//     Route::get('/all', [OrderController::class, 'AllOrders'])->name('orders-all');

//     Route::get('/pending', [OrderController::class, 'PendingOrders'])->name('orders-pending');

//     Route::get('/details/{order_id}', [OrderController::class, 'OrderDetails'])->name('order.details');

//     Route::get('/confirmed', [OrderController::class, 'ConfirmedOrders'])->name('orders-confirmed');

//     Route::get('/processing', [OrderController::class, 'ProcessingOrders'])->name('orders-processing');

//     Route::get('/picked', [OrderController::class, 'PickedOrders'])->name('orders-picked');

//     Route::get('/shipped', [OrderController::class, 'ShippedOrders'])->name('orders-shipped');

//     Route::get('/delivered', [OrderController::class, 'DeliveredOrders'])->name('orders-delivered');

//     Route::get('/canceled', [OrderController::class, 'CanceledOrders'])->name('orders-canceled');

//     Route::get('/pending-to-confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-to-confirm');
//     Route::get('/confirmed-to-processing/{order_id}', [OrderController::class, 'ConfirmedToProcessing'])->name('confirmed-to-processing');
//     Route::get('/processing-to-picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing-to-picked');
//     Route::get('/picked-to-shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked-to-shipped');
//     Route::get('/shipped-to-delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped-to-delivered');

// });

// // Admin Shipping All Routes
// Route::middleware(['auth:admin'])->prefix('shipping')->group(function(){
//     Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');

//     Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');

//     Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');

//     Route::post('/division/update', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');

//     Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');


//     Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');

//     Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');

//     Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');

//     Route::post('/district/update', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');

//     Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');

//     Route::get('/district/ajax/{id}', [ShippingAreaController::class, 'GetDistrictsAjax']);


//     Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');

//     Route::post('/State/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');

//     Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');

//     Route::post('/state/update', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');

//     Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');
// });


// // Frontend All Routes


// // Multi Language All Routes

// Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('bangla.language');

// Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

// // Frontend Product Details Page Url
// Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// // Frontend Product Tags Page
// Route::get('/product/tag/{tag}/', [IndexController::class, 'TagWiseProduct']);

// // Frontend Product View Ajax
// Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// // Frontend Subcategory Wise Data
// Route::get('/subcategory/product/{id}/{slug}', [FProductController::class, 'SubCatWiseProduct']);

// // Frontend SubSubCateogry Wise Data
// Route::get('/subsubcategory/product/{id}/{slug}', [FProductController::class, 'SubSubCatWiseProduct']);

// // Frontend Add To Cart Store Data
// Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// // Frontend Mini Cart
// Route::get('/product/mini/cart/', [CartController::class, 'MiniCart']);
// // Frontend Mini Cart Item Remove
// Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCartItem']);

// // Frontend Add To Wishlist Store Data
// Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishlist']);

// // Frontend Wishlist Page
// Route::group(['prefix'=>'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function() {
//     Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
//     Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
//     Route::get('/wishlist-product-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

//     Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');

// });

// // My Cart Page All Routes
// Route::get('/user/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
// Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);
// Route::get('/user/cart-product-remove/{id}', [CartPageController::class, 'RemoveCartProduct']);
// Route::get('/user/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
// Route::get('/user/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

// // Frontend Coupon Routes
// Route::post('/coupon-apply', [CartPageController::class, 'CouponApply']);
// Route::get('/coupon-calculation', [CartPageController::class, 'CouponCalculation']);
// Route::get('/coupon-remove', [CartPageController::class, 'CouponRemove']);

// // Checkout Routes
// Route::get('/checkout', [CartPageController::class, 'Checkout'])->name('checkout');
// Route::get('/checkout/district/ajax/{id}', [CheckoutController::class, 'GetDistrictsAjax']);
// Route::get('/checkout/state/ajax/{id}', [CheckoutController::class, 'GetStatesAjax']);
// Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

// Route::group(['prefix'=>'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function() {
//     Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
//     Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');
//     Route::get('/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
//     Route::get('/order-details/{order_id}', [AllUserController::class, 'OrderDetails']);
//     Route::get('/invoice_download/{order_id}', [AllUserController::class, 'Invoice']);
// }); -->