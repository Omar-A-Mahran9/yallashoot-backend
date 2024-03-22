<?php

use App\Http\Controllers\Dashboard\CarController;
use App\Http\Controllers\Dashboard\DelegatesController;
use App\Http\Controllers\Dashboard\FinanceApprovalsController;
use App\Http\Controllers\Dashboard\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/send', function () {
    storeAndPushNotification('موعد صيانة جديد', 'New appointment', 'تم حجز موعد صيانة جديد من بتاري 31-05-2023 الساعة 1:00 م اضغط لعرض التفاصيل', 'تم حجز موعد صيانة جديد من بتاري 31-05-2023 الساعة 1:00 م اضغط لعرض التفاصيل', '<svg width="25" height="28" viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7.40094 3.4401V2.10677C7.40033 1.76658 7.52977 1.43903 7.76277 1.19116C7.99577 0.943285 8.3147 0.793848 8.65427 0.773438H16.0009C16.3381 0.797099 16.6538 0.947953 16.884 1.19548C17.1142 1.44301 17.2418 1.76874 17.2409 2.10677V3.4401C17.2418 3.77813 17.1142 4.10386 16.884 4.35139C16.6538 4.59892 16.3381 4.74978 16.0009 4.77344H8.65427C8.3147 4.75303 7.99577 4.60359 7.76277 4.35572C7.52977 4.10785 7.40033 3.78029 7.40094 3.4401ZM24.0009 10.3068V19.9334C24.0168 20.8755 23.847 21.8114 23.5011 22.6878C23.1552 23.5642 22.6401 24.3639 21.9851 25.0412C21.3301 25.7185 20.5481 26.2601 19.6837 26.6351C18.8194 27.0101 17.8897 27.2111 16.9476 27.2268H7.08094C5.18074 27.2022 3.36795 26.4246 2.04054 25.0646C0.713134 23.7047 -0.0204132 21.8737 0.000939745 19.9734V10.3468C-0.0270515 8.61371 0.571086 6.92871 1.68552 5.60118C2.79996 4.27366 4.35589 3.39271 6.06761 3.1201V3.4401C6.06729 4.1337 6.33724 4.80013 6.82016 5.29799C7.30309 5.79585 7.96099 6.08596 8.65427 6.10677H16.0009C16.6919 6.08257 17.3464 5.79097 17.8265 5.29348C18.3066 4.79598 18.5747 4.13147 18.5743 3.4401V3.21344C20.1405 3.62092 21.5255 4.54049 22.5088 5.82584C23.4921 7.1112 24.0174 8.68849 24.0009 10.3068ZM7.80094 15.4134L10.9743 19.3334C11.0666 19.4457 11.1826 19.5362 11.314 19.5985C11.4454 19.6607 11.5889 19.6931 11.7343 19.6934C11.8856 19.6924 12.0345 19.6557 12.1689 19.5861C12.3033 19.5166 12.4193 19.4163 12.5076 19.2934L16.8543 13.4401C16.9828 13.2317 17.0357 12.9855 17.0041 12.7427C16.9726 12.4999 16.8585 12.2754 16.6809 12.1068C16.4748 11.9647 16.2224 11.9064 15.9748 11.9435C15.7272 11.9806 15.503 12.1105 15.3476 12.3068L11.7476 17.1468L9.33427 14.1601C9.17326 13.9701 8.94633 13.8479 8.69903 13.8183C8.45172 13.7886 8.20234 13.8536 8.00094 14.0001C7.79628 14.1676 7.66209 14.4059 7.62504 14.6677C7.58799 14.9296 7.65078 15.1958 7.80094 15.4134Z" fill="currentColor"/>
</svg>', 'success', '/dashboard/appointments');
    dd("done");
});

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'dashboard.', 'middleware' => ['web', 'auth:employee', 'set_locale']], function () {

    /** set theme mode ( light , dark ) **/
    Route::get('/change-theme-mode/{mode}', 'SettingController@changeThemeMode');

    /** dashboard index **/
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/allemployees', 'OrderController@employeeapi');

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
    Route::resource('news', 'NewsController');
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