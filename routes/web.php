<?php

use App\Order;
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

// login with google
// Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
// Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');

// Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');
Route::group(['middleware' => 'locale'], function() {

    Auth::routes();

    Route::get('change-language/{language}', 'ClientController@changeLanguage')->name('user.change-language');

    Route::post('login', 'UserController@login')->name('postLogin');

    Route::get('logout', 'UserController@logoutUser')->name('logout');

// route admin
    Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

        Route::get('index', 'HomeController@index')->name('admin.index');

        Route::get('/', 'HomeController@index')->name('admin.index');

        Route::get('logout', 'UserController@logoutAdmin')->name('admin.logout');

        Route::group(['prefix' => 'role'], function () {

            Route::get('index', 'RoleController@index')->name('admin.role.index');

            Route::get('json', 'RoleController@getDataJson')->name('admin.role.json');

            Route::post('store', 'RoleController@store')->name('admin.role.store');

            Route::post('update/{id}', 'RoleController@update')->name('admin.role.update');

            Route::get('destroy/{id}', 'RoleController@destroy')->name('admin.role.destroy');
        });

        Route::group(['prefix' => 'user'], function () {

            Route::get('index', 'UserController@index')->name('admin.user.index');

            Route::get('json', 'UserController@json')->name('admin.user.json');

            Route::get('create', 'UserController@create')->name('admin.user.create');

            Route::post('store', 'UserController@store')->name('admin.user.store');

            Route::get('edit', 'UserController@edit')->name('admin.user.edit');

            Route::post('update/{user}', 'UserController@update')->name('admin.user.update');

            Route::get('destroy/{user}', 'UserController@destroy')->name('admin.user.destroy');

            Route::get('active/{user}', 'UserController@active')->name('admin.user.active');
        });

        Route::group(['prefix' => 'product'], function () {

            Route::get('index', 'ProductController@index')->name('admin.product.index');

            Route::get('show/{id}', 'ProductController@show')->name('admin.product.show');

            Route::post('store', 'ProductController@store')->name('admin.product.store');

            Route::post('update/{product}', 'ProductController@update')->name('admin.product.update');


            Route::post('destroy_image', 'ProductController@destroy_image')->name('admin.product.destroy_image');

            Route::get('destroy/{id}', 'ProductController@destroy')->name('admin.product.destroy');

            Route::get('json', 'ProductController@getAllData')->name('admin.product.json');

            Route::get('category-select', 'ProductController@getCategorySelect')->name('admin.product.category_select');
        });

        Route::group(['prefix' => 'category'], function () {

            Route::get('index', 'CategoryController@index')->name('admin.category.index');

            Route::post('store', 'CategoryController@store')->name('admin.category.store');

            Route::post('update/{category}', 'CategoryController@update')->name('admin.category.update');

            Route::get('destroy/{id}', 'CategoryController@destroy')->name('admin.category.destroy');

            Route::get('json', 'CategoryController@getCategoryJson')->name('admin.category.json');
        });

        Route::group(['prefix' => 'slide'], function () {
             Route::get('show/{id}', 'SlideController@show')->name('admin.slide.show');
            Route::get('index', 'SlideController@index')->name('admin.slide.index');

            Route::post('store', 'SlideController@store')->name('admin.slide.store');

            Route::post('update/{slide}', 'SlideController@update')->name('admin.slide.update');

            Route::get('destroy/{id}', 'SlideController@destroy')->name('admin.slide.destroy');
            Route::get('json', 'SlideController@getCategorySelect')->name('admin.slide.json');

        });

        Route::group(['prefix' => 'contact'], function () {
            Route::get('show/{id}', 'ContactController@show')->name('admin.contact.show');
            Route::get('index', 'ContactController@index')->name('admin.contact.index');
            Route::get('destroy/{id}', 'ContactController@destroy')->name('admin.contact.destroy');
            Route::get('json', 'ContactController@getAllData')->name('admin.contact.json');
        });

        Route::group(['prefix' => 'topping'], function () {

            Route::get('json', 'TopingController@getDataJson')->name('admin.topping.json');

            Route::get('index', 'TopingController@index')->name('admin.topping.index');

            Route::post('store', 'TopingController@store')->name('admin.topping.store');

            Route::post('update/{topping}', 'TopingController@update')->name('admin.topping.update');

            Route::get('destroy/{id}', 'TopingController@destroy')->name('admin.topping.destroy');
        });

        Route::group(['prefix' => 'size'], function () {

            Route::get('index', 'SizeController@index')->name('admin.size.index');

            Route::get('json', 'SizeController@getDataJson')->name('admin.size.json');

            Route::post('store', 'SizeController@store')->name('admin.size.store');

            Route::post('update/{size}', 'SizeController@update')->name('admin.size.update');

            Route::get('destroy/{id}', 'SizeController@destroy')->name('admin.size.destroy');
        });

        Route::group(['prefix' => 'order'], function () {

            Route::get('index', 'OrderController@index')->name('admin.order.index');

            Route::get('show/{id}', 'OrderController@show')->name('admin.order.show');

            Route::get('json', 'OrderController@getALl')->name('admin.order.json');

            Route::get('detail/{id}', 'OrderController@showDetail')->name('admin.order.detail.json');

            Route::get('delete/{id}', 'OrderController@destroy')->name('admin.order.destroy');

            Route::post('change-status', 'OrderController@changStatus')->name('admin.order.change_status');
        });
    });
//end admin

    Route::group(['prefix' => 'user', 'middleware' => 'userLogin'], function () {

    Route::get('profile/{user}', 'UserController@edit')->name('user.edit');

    Route::post('update/{user}', 'UserController@update')->name('user.update');

    Route::get('show/{id}', 'UserController@show')->name('user.show');
    });

    Route::group(['middleware' => 'userLogin'], function () {

    Route::get('edit/{user}', 'UserController@edit')->name('user.edit');
    });

    Route::get('/', 'ClientController@index')->name('client.index');

    Route::post('live-search', 'ClientController@liveSearch')->name('client.live_search');

    Route::get('search', 'ClientController@search')->name('client.search');

    Route::get('product/{id}', 'ClientController@detailProduct')->name('client.product.detail');

    Route::get('product/{id}/json', 'ClientController@detailProductData')->name('client.product.detail.json');

    Route::post('comment', 'ClientController@comment')->name('client.comment');

    Route::get('cart-data', 'Cart1Controller@cart')->name('client.cart');

    Route::get('cart', 'ClientController@cart')->name('client.showCart');
    Route::get('category/{category_id}', 'ClientController@showProductByCate')->name('client.showProductByCate');

    Route::post('cart-add', 'Cart1Controller@add')->name('user.cart.add');

    Route::post('cart-reduce', 'Cart1Controller@reduce_quantity')->name('user.cart.reduce');

    Route::post('cart-increase', 'Cart1Controller@increase_quantity')->name('user.cart.increase');

    Route::get('cart-delete/{key}', 'Cart1Controller@delete')->name('user.cart.delete');

    Route::get('cart-remove-all', 'Cart1Controller@removeAll')->name('user.cart.remove');

    Route::post('client-feedback', 'FeedbackController@store')->name('feedback.store');

    Route::get('contact', 'ClientController@getContact')->name('user.contact.get');

    Route::post('contact', 'ClientController@postContact')->name('user.contact.post');

    Route::get('order', 'ClientController@orders')->name('client.orders');

    Route::get('order_detail/{order_id}', 'ClientController@order_details')->name('client.order.order_detail');

    Route::get('cancel_order/{order_id}', 'ClientController@cancel_order')->name('client.order.cancel_order');

    Route::get('profile', 'ClientController@profile')->name('client.profile');

    Route::get('client/login', 'ClientController@login')->name('client.login');

    Route::get('registerGet', 'ClientController@register')->name('client.register');

    Route::post('registerPost', 'ClientController@registerPost')->name('client.registerPost');

    Route::get('filter', 'ClientController@filter')->name('client.filter');

    Route::post('favorite', 'ClientController@favorite')->name('client.favorite');

    Route::post('checkout', 'ClientController@checkout')->name('client.checkout');
});
