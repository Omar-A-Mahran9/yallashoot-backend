<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Employee;
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
        // $this->app['request']->server->set('HTTPS', true);

        if(request()->segment(2) != 'dashboard' && Schema::hasTable('brands'))
        {
            $brands  = Brand::select('id','image','name_en','name_ar', 'car_available_types' )->whereNotNull('car_available_types')->get();
            view()->share(['brands' => $brands]);
        }

        View::composer('partials.dashboard.header', function ($view) {
            $unreadNotifications = Employee::first()->unreadNotifications();
            $allNotifications = Employee::first()->notifications();

            $view->with(['unreadNotifications' => $unreadNotifications, "allNotifications" => $allNotifications]);
        });

        View::composer('partials.dashboard.aside', function ($view) {
            $unreadNotifications = Employee::first()->unreadNotifications()->take(5)->get();

            $view->with(['unreadNotifications' => $unreadNotifications]);
        });
    }
}
