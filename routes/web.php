<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    });
    
});
Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/','IndexController@index');
});

