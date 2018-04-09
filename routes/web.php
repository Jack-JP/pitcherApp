<?php

Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
Route::view('/product', 'product');

Route::get('/cart', 'CartController@index')->name('cart.index');

Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/wishlist/{product}', 'CartController@wishlist')->name('cart.wishlist');


Route::delete('/wishlist/{product}', 'WishlistController@destroy')->name('wishlist.destroy');
Route::post('/wishlist/wishlist/{product}', 'WishlistController@addtocart')->name('wishlist.addtocart');

Route::get('/empty', function(){
  Cart::destroy();
});
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');


Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/search', 'ShopController@search')->name('search');

Route::get('/search-algolia', 'ShopController@searchAlgolia')->name('search-algolia');

Route::post('/vote', 'RatingsController@store');

Route::resource('/contact', 'ContactController');
