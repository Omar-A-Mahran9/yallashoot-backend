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
    apiKey: "AIzaSyBKAFopcbws7CFhDXXH2fsqPN7cBwofOwA",
    authDomain: "alkethiri-8c10e.firebaseapp.com",
    projectId: "alkethiri-8c10e",
    storageBucket: "alkethiri-8c10e.appspot.com",
    messagingSenderId: "703728372028",
    appId: "1:703728372028:web:2aade5cba2f6c7826cb639",
    measurementId: "G-4X748VEXWL"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
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
