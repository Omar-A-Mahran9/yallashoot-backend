<?php

namespace Webstdy\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webstdy\Notification\Models\Employee;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Employee::first()->notifications->where('id', $id)->first();
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }

    public function markAllAsRead()
    {
        $notification = Employee::first()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function loadMore($type, $next)
    {
        if ($type == 'unread-load-more')
            $notifications = Employee::first()->unreadNotifications();
        else
            $notifications = Employee::first()->notifications();

        $notifications = $notifications->skip($next)->take(10)->get()->map(function($notification){
            return [
                'id' => $notification->id,
                'color' => $notification->data['color'],
                'icon' => $notification->data['icon'],
                'title_ar' => $notification->data['title_ar'],
                'title_en' => $notification->data['title_en'],
                'description_ar' => $notification->data['description_ar'],
                'description_en' => $notification->data['description_en'],
                'created_at' => $notification->created_at->diffForHumans(),
            ];
        });


        return response()->json([
            'data' => $notifications,
            'isMoreExist' => $notifications->skip($next)->count() > 0,
        ]);
    }

    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token' => $request->token]);
        return response()->json(['token saved successfully.']);
    }
}
