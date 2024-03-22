// For Firebase JS SDK v7.20.0 and later, measurementId is optional
// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyBKAFopcbws7CFhDXXH2fsqPN7cBwofOwA",
    authDomain: "alkethiri-8c10e.firebaseapp.com",
    projectId: "alkethiri-8c10e",
    storageBucket: "alkethiri-8c10e.appspot.com",
    messagingSenderId: "703728372028",
    appId: "1:703728372028:web:2aade5cba2f6c7826cb639",
    measurementId: "G-4X748VEXWL"
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
