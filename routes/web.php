<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    //Admin login Route 
    Route::match(['get','post'],'login','AdminController@login');

    Route::group(['middleware'=>['admin']],function(){
        //Admin Dashboard Route
        Route::get('dashboard','AdminController@dashboard');
        //Update Admin Password
        Route::match(['get','post'],'update-admin-password','AdminController@updateAdminPassword');
        //Check Admin Password
        Route::post('check-current-password','AdminController@checkCurrentPassword');
        //Update Admin Details
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');
        //Update Vendor Details
        Route::match(['get','post'],'update-vendor-details/{slug}','AdminController@updateVendorDetails');
        //Admin SubAdmin Vendor
        Route::get('admins/{type?}','AdminController@admins');
        //View Vendor Details
        Route::get('view-vendor-details/{id}','AdminController@viewVendorDetails');
        //Update Admin Status
        Route::post('update-admin-status','AdminController@updateAdminStatus');
        //Admin Logout
        Route::get('logout','AdminController@logout');
        //Sections
        Route::get('sections','SectionController@sections');
        Route::get('delete-section/{id}','SectionController@deleteSection');
        Route::post('update-section-status','SectionController@updateSectionStatus');
        Route::match(['get','post'],'add-edit-section/{id?}','SectionController@addEditSection');
        //Categories
        Route::get('categories','CategoryController@categories');
        Route::post('update-category-status','CategoryController@updateCategoryStatus');
        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
        Route::get('delete-category/{id}','CategoryController@deleteCategory');
        Route::get('append-categories-lavel','CategoryController@appendCategoriesLavel');
        //Brands
        Route::get('brands','BrandController@brands');
        Route::get('delete-brand/{id}','BrandController@deleteBrand');
        Route::post('update-brand-status','BrandController@updateBrandStatus');
        Route::match(['get','post'],'add-edit-brand/{id?}','BrandController@addEditBrand');
        //Products
        Route::get('products','ProductController@products');
        Route::post('update-product-status','ProductController@updateProductStatus');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductController@addEditProduct');
        Route::get('delete-product/{id}','ProductController@deleteProduct');
        Route::get('delete-product-image/{id}','ProductController@deleteProductImage');
        //Add Attributes Route
        Route::match(['get','post'],'add-edit-attributes/{id}','ProductController@addAttributes');
        Route::post('update-attribute-status','ProductController@updateAttributeStatus');
        Route::get('delete-attribute/{id}','ProductController@deleteAttribute');
        Route::match(['get','post'],'edit-attribute/{id}','ProductController@editAttribute');
        //Add edit Filters and values
        Route::get('filters','FilterController@filters');
        Route::get('delete-filter/{id}','FilterController@deleteFilter');
        Route::post('update-filter-status','FilterController@updateFilterStatus');
        Route::match(['get','post'],'add-edit-filter/{id?}','FilterController@addEditFilter');
        //Filters Values
        Route::get('filters-values','FilterController@filtersValues');
        Route::get('delete-filter_value/{id}','FilterController@deleteFilterValue');
        Route::post('update-filter-value-status','FilterController@updateFiltersValueStatus');
        Route::match(['get','post'],'add-edit-filter-value/{id?}','FilterController@addEditFilterValue');
        Route::post('category-filters','FilterController@categoryFilters');
        //Add Multiple Images
        Route::match(['get','post'],'add-images/{id}','ProductController@addImages');
        Route::post('update-image-status','ProductController@updateImageStatus');
        Route::get('delete-image/{id}','ProductController@deleteImage');
        //Banners
        Route::get('banners','BannersController@banners');
        Route::post('update-banner-status','BannersController@updateBannerStatus');
        Route::get('delete-banner/{id}','BannersController@deleteBanner');
        Route::match(['get','post'],'add-edit-banners/{id?}','BannersController@addEditBanner');
        //Rating Route
        Route::get('ratings','RatingController@ratings');
        Route::post('update-rating-status','RatingController@updateRatingStatus');
        Route::get('delete-rating/{id}','RatingController@deleteRating');
    });
    
});
//Route For Front Page
Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/','IndexController@index');
    //Listing Product Route
     $catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
     foreach($catUrls as $key => $url){
        Route::match(['get','post'],'/'.$url,'ProductController@listing');
     }
     //Singel Product Details Route
     Route::get('/product/{id}','ProductController@detail');
     //Get Product Attribute Price
     Route::post('get-product-price','ProductController@getProductPrice');
     //Vendor Login/Register Route
     Route::get('vendor/login-register','VendorController@loginRegister');
     //Register Route
     Route::post('vendor/register','VendorController@vendorRegister');
     //Confirm mail
     Route::get('vendor/confirm/{code}','VendorController@confirmVendor');
     //Get Vendor Details and Products Route 
     Route::get('/products/{vendorid}','ProductController@vendorListing');
     // Add to Cart Route
     Route::post('cart/add','ProductController@cartAdd');
     //Cart Route
     Route::get('/cart','ProductController@cart');
    //User Login/Register Route
    Route::get('user/login-register','UserController@loginRegister');
    Route::post('user/register','UserController@userRegister');
    Route::get('user/logout','UserController@userLogout');
    Route::post('user/login','UserController@userLogin');
    //user confirm route
    Route::get('user/confirm/{code}','UserController@confirmAccount');
    //User Account Route
    Route::match(['get','post'],'user/account','UserController@userAccount');
    //Add Rating Route
    Route::post('add-rating','RatingController@addRating');
});

