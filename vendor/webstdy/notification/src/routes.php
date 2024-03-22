<?php

namespace Webstdy\Notification;
use Illuminate\Support\Facades\Route;

Route::get('test', function (){
    dd('hello from test');
});

/** notifications routes **/

Route::post('/save-token', 'Webstdy\Notification\NotificationController@saveToken')->name('save-token');
Route::get('notifications/{id}/mark_as_read', 'Webstdy\Notification\NotificationController@markAsRead')->name('notifications.mark_as_read');
Route::get('notifications/{type}/load-more/{next}', 'Webstdy\Notification\NotificationController@loadMore')->name('notifications.load_more');
Route::get('notifications/mark-all-as-read', 'Webstdy\Notification\NotificationController@markAllAsRead')->name('notifications.mark_all_as_read');
Route::post('notifications/change-status-sound' , 'Webstdy\Notification\NotificationController@changeSoundStatus')->name('notifications.change-sound-status');
