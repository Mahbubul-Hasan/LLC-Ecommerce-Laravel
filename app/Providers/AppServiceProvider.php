<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable("categories"))
        {
            $size = Category::count() / 2;
            $data["categories_1"] = Category::where("c_active", "1")->take($size)->orderBy("id", "desc")->get();
            $data["categories_2"] = Category::where("c_active", "1")->skip($size)->take($size)->orderBy("id", "desc")->get();
            View::share($data);
        }
    }
}
