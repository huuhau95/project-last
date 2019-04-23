<?php

namespace App\Providers;

use App\User;
use App\Product;
use App\Category;
use App\Size;
use App\Topping;
use App\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // set link resource from http -> https
        // \URL::forceScheme('https');

        view()->composer('layouts/header', function ($view) {
            if (Auth::check()) {
                $data['currentUser'] = Auth::user();
                $data['active'] = User::where('active', 0)->get();
                $data['feedback'] = Feedback::where('status', 0)->with('user')->get();
                $view->with('data', $data);
            }
        });

        view()->composer('index', function ($view) {
            $categories = Category::all();
            $sizes = Size::all();
            $toppings = Topping::all();
            $view->with(['categories' => $categories, 'sizes' => $sizes, 'toppings' => $toppings]);
        });

        view()->composer('product_detail', function ($view) {
            $categories = Category::all();
            $sizes = Size::all();
            $toppings = Topping::all();
            $view->with(['categories' => $categories, 'sizes' => $sizes, 'toppings' => $toppings]);
        });

        view()->composer('layouts/menu_client', function ($view) {
            $category = Category::with(['products'])->get()->map(function ($query) {
                $query->setRelation('products', $query->products->take(4));
                return $query;
            });
            $view->with('category_with_product', $category);
        });

        view()->composer('filter', function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });

        view()->composer('cart', function ($view) {

            if (Auth::check())
                $user = User::with('potential')->findOrFail(Auth::user()->id);
            else
                $user = '';


            $view->with('user', $user);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
