<?php

use App\Http\Controllers\Dashboard\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/language/{lang}', [SettingController::class, 'changeLanguage'])->name('change-language');
Route::get('/', function () {
    return redirect('/dashboard');
})->name('index');
Route::group(['namespace' => 'Auth' , 'middleware' => 'set_locale'] , function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    })->name('index');
    // employee login routes
    Route::get('employee/login','EmployeeAuthController@showLoginForm')->name('employee.login-form');
    Route::post('employee/login','EmployeeAuthController@login')->name('employee.login');
    Route::post('employee/logout','EmployeeAuthController@logout')->name('employee.logout');

    // user login routes
    Route::get('employee/login','EmployeeAuthController@showLoginForm')->name('employee.login-form');
});

Route::group(['namespace' => 'Home' , 'middleware' => 'set_locale', 'as' => 'home.'] , function () {
    Route::get('/calculator','CalculatorController@index')->name('calculator');
    Route::post('/amount-calculator','CalculatorController@calculate')->name('amount-calculator');
    Route::post('/calculate-installments','CalculatorController@calculateInstallmentss')->name('calculateInstallments');
    Route::post('/individuals-finance','OrderController@individualsFinance')->name('individualsFinance');
});


// Route::get('update-db', function () {

//     Artisan::call('migrate:fresh');
//     Artisan::call('db:seed');
//     Artisan::call('config:cache');

//     dd('done');

// });

// Route::get('/brands', function () {
//     return view('web.brands');
// })->name('brands');

// Route::get('/cars', function () {
//     return view('web.cars');
// })->name('cars');

// Route::get('/car', function () {
//     return view('web.car');
// })->name('car');

// Route::get('/offers', function () {
//     return view('web.offers');
// })->name('offers');

// Route::get('/offer-details', function () {
//     return view('web.offer-details');
// })->name('offer-details');

// Route::get('/faq', function () {
//     return view('web.faq');
// })->name('faq');

// Route::get('/news', function () {
//     return view('web.news');
// })->name('news');

// Route::get('/single-news', function () {
//     return view('web.single-news');
// })->name('single-news');

// Route::get('/fav', function () {
//     return view('web.fav');
// })->name('fav');

// Route::get('/maintenance', function () {
//     return view('web.maintenance');
// })->name('maintenance');

// Route::get('/order-placed', function () {
//     return view('web.order-placed');
// })->name('order-placed');

// Route::get('/careers', function () {
//     return view('web.careers');
// })->name('careers');

// Route::get('/apply', function () {
//     return view('web.apply');
// })->name('apply');

// Route::get('/contact', function () {
//     return view('web.contact');
// })->name('contact');

// Route::get('/purchase', function () {
//     return view('web.purchase');
// })->name('purchase');