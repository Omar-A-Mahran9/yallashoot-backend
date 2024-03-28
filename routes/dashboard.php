<?php

use App\Http\Controllers\Dashboard\CarController;
use App\Http\Controllers\Dashboard\DelegatesController;
use App\Http\Controllers\Dashboard\FinanceApprovalsController;
use App\Http\Controllers\Dashboard\OrderController;
 
use Illuminate\Support\Facades\Route;
 

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'dashboard.', 'middleware' => ['web', 'auth:employee', 'set_locale']], function () {

    /** set theme mode ( light , dark ) **/
    Route::get('/change-theme-mode/{mode}', 'SettingController@changeThemeMode');

    /** dashboard index **/
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/allemployees', 'OrderController@employeeapi');

    Route::resource('news', 'NewsController');
    Route::resource('league', 'LeagueController');
    Route::resource('continent', 'ContinentController');
    Route::resource('country', 'CountryController');
    Route::resource('coache', 'CoacheController');
    Route::resource('player', 'PlayerController');
    Route::resource('playground', 'PlaygroundController');
    Route::resource('games', 'GamesController');
    Route::resource('team', 'TeamController');




    Route::get('/open-calculator', 'DashboardController@openCalculator')->name('calculator');
    Route::post('/calculate-installment', 'DashboardController@calculateInstallment')->name('calculateInstallment');
    Route::get('/get-models/{brandId}', [CarController::class, 'getModels']);
    Route::get('/get-categories/{modelId}', [CarController::class, 'getcategories']);
    Route::get('/delegate/fetch', [DelegatesController::class, 'fetchDelegate']);

    /** resources routes **/
    Route::resource('orders', 'OrderController');
    Route::resource('roles', 'RoleController');
    Route::resource('brands', 'BrandController');
    Route::resource('models', 'ModelController');
    Route::resource('cars', 'CarController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('colors', 'ColorController');
    Route::resource('tags', 'TagController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('vendors', 'VendorController');
    Route::resource('banks', 'BankController');
    Route::resource('financeing', 'FiananceController');

    Route::resource('bank-offers', 'BankOfferController');
    Route::resource('services', 'ServiceController');
    Route::resource('branches', 'BranchController');
    Route::resource('cities', 'CityController');
    Route::resource('faqs', 'FaqController');
    Route::resource('offers', 'OfferController');
    Route::resource('contact-us', 'ContactUsController')->except(['store', 'create', 'destroy']);
    Route::resource('news-subscribers', 'NewsSubscriberController')->except(['store', 'create', 'show']);
    Route::resource('settings', 'SettingController')->only(['index', 'store']);
    Route::resource('careers', 'CareerController');
    Route::get('/applicants', 'CareerController@applicants');
    Route::resource('features', 'FeatureController');
    Route::resource('packages', 'PackageController');
    Route::resource('delegates', 'DelegatesController');

    Route::resource('finance-approvals', 'FinanceApprovalsController');
    Route::get('/finance-approvals/pdf/{id}', [FinanceApprovalsController::class, 'financeapprovalPDF']);


    /** duplicate car **/
    Route::get('/cars/{car}/duplicate', 'CarController@edit');
    Route::get('/cars/{car}/images', 'CarController@images');
    Route::post('dropzone/validate-image', 'DropzoneController@validateImage');

    /** notifications routes **/
    Route::post('/save-token', 'NotificationController@saveToken')->name('save-token');
    Route::get('notifications/{id}/mark_as_read', 'NotificationController@markAsRead')->name('notifications.mark_as_read');
    Route::get('notifications/{type}/load-more/{next}', 'NotificationController@loadMore')->name('notifications.load_more');
    Route::get('notifications/mark-all-as-read', 'NotificationController@markAllAsRead')->name('notifications.mark_all_as_read');
    Route::post('notifications/change-status-sound', 'NotificationController@changeSoundStatus')->name('notifications.change-sound-status');

    /** ajax routes **/
    Route::get('role/{role}/employees', 'RoleController@employees');
    Route::post('car-validate/{car?}', 'CarController@validateStep');
    Route::post('change-status/{order}', 'OrderController@changeStatus');
    Route::post('assigntoemployee/{order}', [OrderController::class, 'assignToEmployee']);


    /** employee profile routes **/

    Route::view('edit-profile', 'dashboard.employees.edit-profile')->name('edit-profile');
    Route::put('update-profile', 'EmployeeController@updateProfile')->name('update-profile');
    Route::put('update-password', 'EmployeeController@updatePassword')->name('update-password');

    /** Trash routes */

    Route::get('trash/{modelName?}', 'TrashController@index')->name('trash');
    Route::get('trash/{modelName}/{id}', 'TrashController@restore');
    Route::delete('trash/{modelName}/{id}', 'TrashController@forceDelete');
    Route::get('/Images/{type}', function ($type) {
        $fileUrl = getImagePathFromDirectory($type, 'Orders');
    
        if (!$fileUrl) {
            abort(404, 'File not found.');
        }
    
        $fileName = basename($fileUrl);
    
        // Fetch file content from URL
        $fileContent = file_get_contents($fileUrl);
        if ($fileContent === false) {
            abort(404, 'Failed to download file.');
        }
    
        // Serve file with appropriate headers to force download
        return response($fileContent, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    })->name('files.download')->middleware('auth');
    
});