<?php

use App\Http\Controllers\SharedController;

/** "shared" means that routes that exist in dashboard and web **/

Route::controller(SharedController::class)->group(function (){

    /** ajax routes **/
    Route::get('get-brand-parent-models/{brand}','getParentModels')->middleware('web','set_locale');
    Route::get('get-model-categories/{model}','getModelCategories')->middleware('web','set_locale');
    Route::get('get-category-cars/{category}','getCategoryCars')->middleware('web','set_locale');
    /** ajax routes **/

});
