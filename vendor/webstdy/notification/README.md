<p align="center"><a href="https://webstdy.com/web/new-logos/logo.svg" target="_blank"><img src="https://webstdy.com/web/new-logos/logo.svg" width="400" alt="Dorak Logo"></a></p>

# Webstdy Notification

### Installation

- Run php artisan make:notification
- Make sure you add Notifiable trait in your used model

Install wia composer:

```
composer require Webstdy/Notification
```

And add the service provider in config/app.php:

```php
Webstdy\Notification\NotificationServiceProvider::class,
```

Add this code to AppServiceProvider:
```php
View::composer('partials.dashboard.header', function ($view) 
{
    $unreadNotifications = Employee::first()->unreadNotifications();
    $allNotifications = Employee::first()->notifications();
    $view->with(['unreadNotifications' => $unreadNotifications, "allNotifications" => $allNotifications]);
});

View::composer('partials.dashboard.aside', function ($view) 
{
    $unreadNotifications = Employee::first()->unreadNotifications()->take(5)->get();
    $view->with(['unreadNotifications' => $unreadNotifications]);
});
```

Replace Employee Model by the notified model:
```php
#example
public function markAllAsRead()
{
    $notification = Employee::first()->unreadNotifications->markAsRead(); //Employee Model is just an example model you must replace it by your model
    return redirect()->back();
}
```

Make a helper function to collect notification data:

```php
function storeAndPushNotification($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, $url)
{
    /* add notification to first Employee */
    $date = Carbon::now()->diffForHumans();
    $notification = new NewNotification($titleAr, $titleEn, $descriptionAr, $descriptionEn, $date, $icon, $color, $url);
    $admin = Employee::first(); //use the model you want, in my case i'm using Employee Model
    $admin->notify($notification);

    /* push notifications to all admins */
    $firebaseToken = Employee::whereNotNull('device_token')->pluck('device_token')->all();
    $SERVER_API_KEY = ""; //use your server api key

    $data = [
        "registration_ids" => $firebaseToken,
        "notification" => [
          // return the data you want
        ]
    ];

    return Http::withHeaders([
        "Authorization" => "key=$SERVER_API_KEY",
    ])->post('https://fcm.googleapis.com/fcm/send', $data);
}
```

Create js file, set configurations in it and put it in public folder: 
```javascript 
/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "", //set firebase apikey
    authDomain: "", //set firebase authDomain
    projectId: "", //set firebase projectId
    storageBucket: "", //set firebase storageBucket
    messagingSenderId: "", //set firebase messagingSenderId
    appId: "", //set firebase appId
    measurementId: "" //set firebase measurementId
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log(
        "[your-file-name.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = payload.notification.alert_title;
    const notificationOptions = {
        // body: payload.data['cm.notification.description'],
        body: "BACKGROUND BODY",
        icon: faviconPath,
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
```

Create js file called listen-to-firebase-notification and put it into js folder in your public folder:
```javascript
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "", //set firebase apikey
    authDomain: "", //set firebase authDomain
    projectId: "", //set firebase projectId
    storageBucket: "", //set firebase storageBucket
    messagingSenderId: "", //set firebase messagingSenderId
    appId: "", //set firebase appId
    measurementId: "" //set firebase measurementId
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

initFirebaseMessagingRegistration();
onPushing();

function onPushing() {
    messaging.onMessage(function(payload) {
        const data = payload.data;
        const noteTitle = data['gcm.notification.alert_title'];

        const noteOptions = {
            icon: faviconPath,
            body: payload.notification[`description_${locale}`],
        };

        $(".no-notifications-alert").addClass('d-none');

        /** append notification **/
        $("#unread-notifications-container,#all-notifications-container").prepend(`
        <div class="d-flex flex-stack py-4 notification-item">
            <!--begin::Section-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-50px me-4">
                    <span class="symbol-label bg-light-${data['gcm.notification.icon_color']}">
                        <span class="svg-icon svg-icon-2x svg-icon-${data['gcm.notification.icon_color']}">
                                ${data['gcm.notification.alert_icon']}
                        </span>
                    </span>
                </div>
                <!--end::Symbol-->

                <!--begin::Title-->
                <div class="mb-0 me-2">
                    <a href="/dashboard/notifications/${data['gcm.notification.id']}/mark_as_read" class="fs-6 text-gray-800 text-hover-primary fw-bold">${data['gcm.notification.alert_title']}</a>
                    <div class="text-gray-400 fs-7">${data[`gcm.notification.description_${locale}`]}</div>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Section-->

            <!--begin::Label-->
            <span class="badge badge-light fs-8">${data['gcm.notification.date']}</span>
            <!--end::Label-->
        </div>
        `);

        let counterSpan = $(".notifications-counter");
        let appointmentsCounterSpan = $("#appointments_counter");
        let counter = parseInt(counterSpan.text());

        if (Number(counter))
            counterSpan.text(`${counter + 1 + translate('unread')}`);
        else
            counterSpan.text(1 + translate('unread'));

        appointmentsCounterSpan.text(parseInt(appointmentsCounterSpan.text()) + 1)

        playNotificationSound();

        new Notification(noteTitle, noteOptions);

        favicon.badge(favIconCounter + 1);
        $('.bullet.bullet-dot').removeClass('d-none');
    });
}

function initFirebaseMessagingRegistration() {
    messaging
        .requestPermission()
        .then(function () {
            return messaging.getToken()
        })
        .then(function(token) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/dashboard/save-token',
                type: 'POST',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function (response) {
                    console.log('Token saved successfully.');
                },
                error: function (err) {
                    console.log('User Chat Token Error'+ err);
                },
            });

        }).catch(function (err) {
        console.log('User Chat Token Error'+ err);
    });
}

/** Load more btn **/
$("#unread-load-more,#all-load-more").click(function (e) {
    e.preventDefault();
    let loadMoreBtn = $(this);
    var type = loadMoreBtn.attr('id');
    var currentNotificationsCount = loadMoreBtn.siblings().length;

    loadMoreBtn.attr('data-kt-indicator', 'on')

    $.ajax({
        type: 'get',
        url: `/dashboard/notifications/${type}/load-more/${currentNotificationsCount}`,
        success: function (res) {
            if(res.data.length == 0){
                loadMoreBtn.remove();

            }else{
                $.each(res.data, function (key, notification) {

                    loadMoreBtn.before(`
                        <div class="d-flex flex-stack py-4 notification-item">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-${notification.color}">
                                        <span class="svg-icon svg-icon-2x svg-icon-${notification.color}">
                                                ${notification.icon}
                                        </span>
                                    </span>
                                </div>
                                <!--end::Symbol-->

                                <!--begin::Title-->
                                <div class="mb-0 me-2">
                                    <a href="/dashboard/notifications/${notification.id}/mark_as_read" class="fs-6 text-gray-800 text-hover-primary fw-bold">${notification[`title_${locale}`]}</a>
                                    <div class="text-gray-400 fs-7">${notification[`description_${locale}`]}</div>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Section-->

                            <!--begin::Label-->
                            <span class="badge badge-light fs-8">${notification.created_at}</span>
                            <!--end::Label-->
                        </div>
                    `);
                });

                loadMoreBtn.attr('data-kt-indicator', 'off')
            }

        }
    });
});
```

Put this code in header:
```blade
<!--begin::Notifications-->
                <div class="d-flex align-items-center ms-3 ms-lg-4">
                    <!--begin::Drawer wrapper-->
                    <div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px position-relative" data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="currentColor" />
                                <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="currentColor" />
                            </svg>
                        </span>

                        <!--end::Svg Icon-->
                        <!--begin::Bullet-->
                        <span class="bullet bullet-dot bg-danger h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink  {{ $unreadNotifications->count() == 0 ? 'd-none' : '' }}"></span>
                        <!--end::Bullet-->
                    </div>
                    <!--end::Drawer wrapper-->

                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" id="kt_menu" data-kt-menu="true" style="">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{ asset('dashboard-assets/media/misc/menu-header-bg.jpg') }}')">
                            <div class="d-flex justify-content-between align-items-center">
                                <!--begin::Title-->
                                <h3 class="text-white fw-semibold px-9 mt-10 mb-6">{{ __('Notifications') }}
                                    @if ($unreadNotifications->count() > 0)
                                        <span class="fs-8 opacity-75 ps-3 notifications-counter">{{$unreadNotifications->count() . ' ' .  __('unread') }}</span>
                                    @else
                                        <span class="fs-8 opacity-75 ps-3 notifications-counter"> {{ __('nothing new') }}</span>
                                    @endif
                                </h3>
                                <!--end::Title-->
                                <a href="{{ route('notifications.mark_all_as_read') }}" class="text-white fw-semibold px-9 mt-10 mb-6">{{ __('Mark all as read') }}</a>
                            </div>

                            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#all_notifications" aria-selected="false" tabindex="-1" role="tab">{{ __('All') }}</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#unread_notifications" aria-selected="true" role="tab">{{ __('Unread') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <div class="tab-pane fade" id="all_notifications" role="tabpanel">
                                <!--begin::Wrapper-->
                                <div class="scroll-y mh-325px min-h-325px my-5 px-8" id="all-notifications-container">
                                    @forelse ($allNotifications->take(10)->get() as $notification)

                                        <div class="d-flex flex-stack py-4 notification-item">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label bg-light-{{ $notification->data['color'] }}">
                                                        <span class="svg-icon svg-icon-2x svg-icon-{{ $notification->data['color'] }}">
                                                                {!! $notification->data['icon'] !!}
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->

                                                <!--begin::Title-->
                                                <div class="mb-0 me-2">
                                                    <a href="{{route('notifications.mark_as_read', $notification->id)}}" class="fs-6 text-gray-800 text-hover-primary fw-bold">
                                                        {{$notification->data['title_' . app()->getLocale()]}}</a>
                                                    <div class="text-gray-400 fs-7">{{$notification->data['description_' . app()->getLocale()]}}</div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->

                                            <!--begin::Label-->
                                            <span class="badge badge-light fs-8">{{$notification->created_at->diffForHumans()}}</span>
                                            <!--end::Label-->
                                        </div>
                                    @empty
                                        <div class="d-flex flex-column px-9 pb-5 no-notifications-alert">
                                            <!--begin::Illustration-->
                                            <div class="text-center px-4">
                                                <img class="mw-100 mh-200px" alt="image" src="{{ asset('dashboard-assets/media/illustrations/unitedpalms-1/notifications.png') }}">
                                            </div>
                                            <!--end::Illustration-->
                                            <!--begin::Section-->
                                            <div class="pt-5 pb-0">
                                                <!--begin::Title-->
                                                <h3 class="text-dark text-center fw-bold">{{ __('There are no new notifications!') }}</h3>
                                                <!--end::Title-->
                                                <!--begin::Text-->
                                                <div class="text-center text-gray-600 fw-semibold pt-1">{{ __('Here it shows you all the notifications from the website to be aware of the latest important processes and events that need to be re-reviewed and a new action taken with them.') }}</div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                    @endforelse

                                    <!--begin::Item-->
                                    @if($allNotifications->count() > 10)
                                        <!--begin::Item-->
                                        <button type="submit" class="btn border-none p-0 d-flex m-auto" data-kt-indicator="" id="all-load-more">
                                        <span class="indicator-label">
                                            <span class="svg-icon svg-icon-danger svg-icon-2x">
                                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) "/>
                                                        <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) "/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                            <span class="indicator-progress">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                        </button>
                                        <!--end::Item-->
                                    @endif
                                    <!--end::Item-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="tab-pane fade show active" id="unread_notifications" role="tabpanel">
                                <!--begin::Wrapper-->
                                <div class="scroll-y mh-325px min-h-325px my-5 px-8" id="unread-notifications-container">
                                    @forelse ($unreadNotifications->take(10)->get() as $notification)
                                        <div class="d-flex flex-stack py-4 notification-item">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label bg-light-{{ $notification->data['color'] }}">
                                                        <span class="svg-icon svg-icon-2x svg-icon-{{ $notification->data['color'] }}">
                                                                {!! $notification->data['icon'] !!}
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->

                                                <!--begin::Title-->
                                                <div class="mb-0 me-2">
                                                    <a href="{{route('notifications.mark_as_read', $notification->id)}}" class="fs-6 text-gray-800 text-hover-primary fw-bold">                       
                                                        {{$notification->data['title_' . app()->getLocale()]}}</a>
                                                    <div class="text-gray-400 fs-7">{{$notification->data['description_' . app()->getLocale()]}}</div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->

                                            <!--begin::Label-->
                                            <span class="badge badge-light fs-8">{{$notification->created_at->diffForHumans()}}</span>
                                            <!--end::Label-->
                                        </div>
                                    @empty
                                        <div class="d-flex flex-column px-9 pb-5" id="no-notification-alert">
                                            <!--begin::Illustration-->
                                            <div class="text-center px-4">
                                                <img class="mw-100 mh-200px" alt="image" src="{{ asset('dashboard-assets/media/illustrations/unitedpalms-1/notifications.png') }}">
                                            </div>
                                            <!--end::Illustration-->
                                            <!--begin::Section-->
                                            <div class="pt-5 pb-0">
                                                <!--begin::Title-->
                                                <h3 class="text-dark text-center fw-bold">{{ __('There are no new notifications!') }}</h3>
                                                <!--end::Title-->
                                                <!--begin::Text-->
                                                <div class="text-center text-gray-600 fw-semibold pt-1">{{ __('Here it shows you all the notifications from the website to be aware of the latest important processes and events that need to be re-reviewed and a new action taken with them.') }}</div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                    @endforelse
                                    <!--begin::Item-->
                                    @if($unreadNotifications->count() > 10)
                                        <!--begin::Item-->
                                        <button type="submit" class="btn border-none p-0 d-flex m-auto" data-kt-indicator="" id="unread-load-more">
                                            <span class="indicator-label">
                                                <span class="svg-icon svg-icon-danger svg-icon-2x">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                                            <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) "/>
                                                            <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) "/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="indicator-progress">
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                        <!--end::Item-->
                                    @endif
                                    <!--end::Item-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        </div>
                        <!--end::Tab content-->
                    </div>
                </div>
                <!--end::Notifications-->
```

Put this code in footer:
```javascript
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-analytics.js"></script>
<script src="{{ asset('path-of-your-js-folder/listen-to-firebase-notification.js') }}"></script>
```

Package Routes:
```php
Route::post('/save-token', 'Webstdy\Notification\NotificationController@saveToken')->name('save-token');
Route::get('notifications/{id}/mark_as_read', 'Webstdy\Notification\NotificationController@markAsRead')->name('notifications.mark_as_read');
Route::get('notifications/{type}/load-more/{next}', 'Webstdy\Notification\NotificationController@loadMore')->name('notifications.load_more');
Route::get('notifications/mark-all-as-read', 'Webstdy\Notification\NotificationController@markAllAsRead')->name('notifications.mark_all_as_read');
Route::post('notifications/change-status-sound' , 'Webstdy\Notification\NotificationController@changeSoundStatus')->name('notifications.change-sound-status');
```

