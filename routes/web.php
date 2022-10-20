<?php

use Illuminate\Support\Facades\Route;

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


////////////////////////////////////////// Login Page Routes //////////////////////////////////////////

// Route to display Login Page
Route::get('index', 'App\Http\Controllers\Icontroller@index');

// Route to user Create session 
Route::post('session_form_submit', 'App\Http\Controllers\Icontroller@session_submit');


////////////////////////////////////////// Page Routes //////////////////////////////////////////

// Route to display page data for editing
Route::get('addpage/{id}', 'App\Http\Controllers\Icontroller@editPage');

// Route to display add Page
Route::get('addpage', 'App\Http\Controllers\Icontroller@page');

// Route to display page summary
Route::get('pageSummary', 'App\Http\Controllers\Icontroller@pagesummary');

// Route to update page data
Route::post('page_update/{id}', 'App\Http\Controllers\Icontroller@update_page');

// Route to add new page
Route::post('page_save', 'App\Http\Controllers\Icontroller@save_page');

// Route to search page in page Summary
Route::post('search', 'App\Http\Controllers\Icontroller@search');

// Route to Delete a Category 
Route::get('deletePage/{id}', 'App\Http\Controllers\Icontroller@deletePage');


////////////////////////////////////////// Category Routes //////////////////////////////////////////

// Route to display category data in Category summary
Route::get('categorysummary', 'App\Http\Controllers\Icontroller@displayCategory');

// Route to display category data in Add Category Page for Updation
Route::get('updateCategory/{id}', 'App\Http\Controllers\Icontroller@updateCategory');

// Route to display Add category Page
Route::get('addcategory', 'App\Http\Controllers\Icontroller@addCategoryPage');

// Route to Add New Category
Route::post('saveCategory', 'App\Http\Controllers\Icontroller@addCategory');

// Route to Update Category
Route::post('updateCategoryForm/{id}', 'App\Http\Controllers\Icontroller@updateCategorySubmit');

// Route to search page in page Summary
Route::post('searchcat', 'App\Http\Controllers\Icontroller@searchCat');

// Route to Delete a Category 
Route::get('deleteCategory/{id}', 'App\Http\Controllers\Icontroller@deleteCategory');


////////////////////////////////////////// Product Routes //////////////////////////////////////////

// Route to display Products page with data
Route::get('productsummary', 'App\Http\Controllers\Icontroller@products');

// Route to display product details in add product page for updation
Route::get('editProduct/{id}', 'App\Http\Controllers\Icontroller@productData');

// Route to open Add new Product page 
Route::get('addproduct', 'App\Http\Controllers\Icontroller@addProduct');

// Route to save new Product 
Route::post('saveProduct', 'App\Http\Controllers\Icontroller@saveProduct');

// Route to search new Product 
Route::post('searchProduct', 'App\Http\Controllers\Icontroller@searchProduct');

// Route to Delete a Product 
Route::get('deleteProduct/{id}', 'App\Http\Controllers\Icontroller@deleteProduct');

// Route to Update Category
Route::post('updateProduct/{id}', 'App\Http\Controllers\Icontroller@updateProduct');


////////////////////////////////////////// Change Password Routes //////////////////////////////////////////

// Route to display Change Password Page
Route::get('changepassword', 'App\Http\Controllers\Icontroller@changePass');

// Route to change password in the database
Route::post('changePassSubmit', 'App\Http\Controllers\Icontroller@changePassSubmit');
