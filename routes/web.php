<?php

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



//---------------------------------Front End------------------------------------

Route::group(["namespace" => "Front"], function ()
{
    Route::get("/", "EcommerceController@index")->name("/");

    Route::get("/product-details/{slug}", "EcommerceController@productDetails")->name("product.details");

    Route::get("/category-products/{slug}", "EcommerceController@categoryProducts")->name("category.products");

    Route::get("/offer-products", "EcommerceController@offerProducts")->name("offer.products");

    Route::resource("/carts", "CartController");
    Route::get("/carts-remove-all", "CartController@cartsRemoveAll")->name("carts.removeAll");

    Route::get("/checkout", "EcommerceController@checkout")->name("checkout")->middleware(["auth", "front"]);
    Route::post("/save-order", "EcommerceController@saveOrder")->name("save.order")->middleware(["auth", "front"]);
});




//---------------------------------Login Process------------------------------------

Route::group(["namespace" => "Login"], function ()
{
    Route::get("/sign-in", "LoginController@showLoginForm")->name("login");
    Route::post("/sign-in", "LoginController@login")->name("login");
    Route::get("/logout", "LoginController@logout")->name("logout");
});




//---------------------------------Admin------------------------------------

Route::group(["prefix" => "admin", "namespace" => "Admin", "as" => "admin.", "middleware" => ["auth", "admin"]], function ()
{
    Route::get("/dashboard", "DashboardController@index")->name("dashboard");

    Route::resource("/categories", "CategoryController");

    Route::resource("/products", "ProductController");

    Route::resource("/orders", "OrderController");
});