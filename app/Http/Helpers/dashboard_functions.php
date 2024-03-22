<?php

use App\Http\Classes\AppSetting;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Webstdy\Notification\NewNotification;

if ( !function_exists('isRtl') ) {

    function isArabic() : bool
    {
        return getLocale() === "ar";
    }

}

if ( !function_exists('isDarkMode') ) {

    function isDarkMode() : bool
    {
        return session('theme_mode') === "dark";
    }

}

if(!function_exists('abilities')){
    function abilities()
    {
        if(is_null( cache()->get('abilities') ))
        {
            $abilities = Cache::remember('abilities', 60, function() {
                return auth('employee')->user()->abilities();
            });
        }else
        {
            $abilities = cache()->get('abilities');
        }


        return $abilities;
    }
}

if(!function_exists('uploadImage')){

    function uploadImage($request, $model = '' ){
        $model        = Str::plural($model);
        $model        = Str::ucfirst($model);
        $path         = "/Images/".$model;
         $originalName =  $request->getClientOriginalName(); // Get file Original Name
        $imageName    = str_replace(' ','','webstdy_' . time() . $originalName);  // Set Image name
        $request->storeAs($path, $imageName,'public');
         return $imageName;
    }
}


if(!function_exists('deleteImage')){

    function deleteImage($imageName, $model){
        $model = Str::plural($model);
        $model = Str::ucfirst($model);

        if ($imageName != 'default.png'){
            $path = "/Images/" . $model . '/' .$imageName;
            Storage::disk('public')->delete($path);
        }
    }
}

if(!function_exists('getImagePathFromDirectory')){

    function getImagePathFromDirectory( $imageName , $directory = null , $defaultImage = 'default.svg'  ): string
    {
        $imagePath = public_path('/storage/Images'.'/' . $directory . '/' . $imageName);
 
        if ( $imageName && $directory && file_exists( $imagePath ) ) // check if the directory is null or the image doesn't exist
            return asset('/storage/Images') .'/' . $directory . '/' . $imageName;
        else
            return asset('placeholder_images/' . $defaultImage);

    }

}

if(!function_exists('uploadImageToDirectory')){

    function uploadImageToDirectory($imageFile, $model = '' ){
        $model        = Str::plural($model);
        $model        = Str::ucfirst($model);
        $path         = "/Images/$model";
        $imageName    = str_replace(' ','','webstdy_' . time() . $imageFile->getClientOriginalName());  // Set Image name
        $imageFile->storeAs($path, $imageName, 'public');
        return $imageName;
    }
}

if(!function_exists('deleteImageFromDirectory')){

    function deleteImageFromDirectory($imageName, $model){
        $model = Str::plural($model);
        $model = Str::ucfirst($model);

        if ($imageName != 'default.png'){
            $path = "/Images/" . $model . '/' .$imageName;
            Storage::disk('public')->delete($path);
        }
    }
}


if(!function_exists('generateWhatsAppLink')){

    function generateWhatsAppLink($phone, $name) {
        // Format the phone number to include the country code
        $formattedPhone = preg_replace('/[^0-9]/', '', $phone); // Remove non-numeric characters
        $formattedPhone = '+966' . $formattedPhone; // Replace YourCountryCode with the actual country code
    
        // Encode the vendor's name for the URL
        $encodedName = urlencode($name);
    
        // Construct the WhatsApp dynamic link
        $whatsappLink = "https://wa.me/{$formattedPhone}?text=Hello%20{$encodedName},%20";
    
        return $whatsappLink;
    }
}


if(!function_exists('isTabActive')){

    function isTabActive($path , $queryParam = '') : string
    {
        if ( request()->segment(2)  === $path && $queryParam == request('type') )
            return 'active';
        else
            return '';
    }
}

if(!function_exists('getLocale')){

    function getLocale() : string
    {
        return app()->getLocale();
    }
}

if(!function_exists('settings')){

    function settings(): AppSetting
    {
        return new AppSetting();
    }

}


if(!function_exists('getRelationWithColumns')){

    function getRelationWithColumns($relations) : array
    {
        $relationsWithColumns = [];

        foreach ( $relations as $relation => $columns)
        {
            array_push($relationsWithColumns , $relation . ":" . implode(",",$columns));
        }

        return $relationsWithColumns;
    }

}

if(!function_exists('getDateRangeArray')){ // takes 'Y-m-d - Y-m-d' and returns [ Y-m-d 00:00:00 , Y-m-d 23:59:59 ]

    function getDateRangeArray($dateRange) : array
    {
        $dateRange = explode( ' - ' , $dateRange );

        return [ $dateRange[0] . ' 00:00:00' , $dateRange[1] . ' 23:59:59'  ];
    }

}

if(!function_exists('currency')){

    function currency() : string
    {
        return ' ' . __( settings()->getSettings('currency') );
    }

}

if(!function_exists('getStatusObject')){

    function getStatusObject($nameEn)
    {
          return array_values( array_filter( settings()->getOrdersStatus()->toArray() ?? [] , fn( $status ) => $status['name_en'] == $nameEn ) )[0] ?? [ "name_ar" => $nameEn , "name_en" => $nameEn, "color" => "#219ed4"];
    }

}


if(!function_exists('getCoordinates')){ // takes google map url and return the coordinates , formatting must be https://www.google.com/maps/?q="lat""lng"

    function getCoordinates($mapUrl) : array
    {
        try {

            $mapUrlLatLng   = substr( parse_url($mapUrl, PHP_URL_QUERY) , 2);
            $lat      = explode( ',' , $mapUrlLatLng )[0];
            $lng      = explode( ',' , $mapUrlLatLng )[1];

            return [$lat , $lng ];

        }catch (Exception $exception){
            dd('formatting is incorrect');
        }
    }

}


if ( !function_exists('getModelData') ) {

    function getModelData(Model $model, $orsFilters = [] , $andsFilters = [] ,$relations = [],$searchingColumns = null,$onlyTrashed = false) : array
    {

        $columns              = $searchingColumns ?? $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        $relationsWithColumns = getRelationWithColumns($relations); // this fn takes [ brand => [ id , name ] ] then returns : brand:id,name to use it in with clause


        /** Get the request parameters **/
        $params = request()->all();

        /** Set the current page **/
        $page = $params['page'] ?? 1;

        /** Set the number of items per page **/
        $perPage = $params['per_page'] ?? 10;

        // set passed filters from controller if exist
        if(!$onlyTrashed)
            $model   = $model->query()->with( $relationsWithColumns );
        else
            $model   = $model->query()->onlyTrashed()->with( $relationsWithColumns );


        /** Get the count before search **/
        $itemsBeforeSearch = $model->count();

        // general search
        if(isset($params['search']['value']))
        {

            if (str_starts_with($params['search']['value'], '0'))
                $params['search']['value'] = substr($params['search']['value'], 1);

            /** search in the original table **/
            foreach ( $columns as $column)
                array_push($orsFilters, [ $column, 'LIKE', "%" . $params['search']['value'] . "%" ]);

        }



        // filter search
        if ($itemsBeforeSearch == $model->count()) {

            $searchingKeys = collect( $params['columns'] )->transform(function($entry) {

                return $entry['search']['value'] != null && $entry['search']['value'] != 'all' ? Arr::only( $entry , ['data', 'name' ,'search']) : null; // return just columns which have search values

            })->whereNotNull()->values();


            /** if request has filters like status **/
            if ( $searchingKeys->count() > 0  )
            {

                /** search in the original table **/
                foreach ($searchingKeys as $column)
                {
                    if ( ! ( $column['name'] == 'created_at' or  $column['name'] == 'date' ) )
                        array_push($andsFilters, [ $column['name'], '=',  $column['search']['value'] ]);
                    else
                    {
                        if( ! str_contains($column['search']['value'] , ' - ') ) // if date isn't range ( single date )
                            $model->orWhereDate( $column['name'] , $column['search']['value']);
                        else
                            $model->orWhereBetween( $column['name'] , getDateRangeArray( $column['search']['value'] ));
                    }
                }

            }

        }

        $model   = $model->where( function ($query) use ( $orsFilters ) {
            foreach ($orsFilters as  $filter)
               $query->orWhere([$filter]);
        });

        if ( $andsFilters )
            $model->where($andsFilters);

        if(isset($params['order'][0]))
        {
            $model->orderBy($params['columns'][$params['order'][0]['column']]['data'], $params['order'][0]['dir']);
        }

        $model->orderby('created_at','desc');

        $response = [
            "recordsTotal" => $model->count(),
            "recordsFiltered" => $model->count(),
            'data' => $model->skip(($page - 1) * $perPage)->take($perPage)->get()
        ];

        return $response;
    }

}


/** favourite functions **/

if(!function_exists('getFavouriteCars')){

    function getFavouriteCars() : array
    {
        return session()->get('favourite_cars_id') ?? [];
    }

}

if(!function_exists('addToFavourite')){

    function addToFavourite($carId)
    {
        if ( ! in_array($carId , getFavouriteCars()) ) {
            session()->push('favourite_cars_id' , $carId) ;
            session()->save();
        }
    }

}


if(!function_exists('removeFromFavourite')){

    function removeFromFavourite($carId)
    {
        $favouriteCars = array_filter( getFavouriteCars() , fn( $id ) => $id != $carId );
        session()->put('favourite_cars_id' , $favouriteCars) ;
        session()->save();
    }

}

/**
 * push firebase notification .
 * Author : Khaled
 * created By Khaled @ 15-06-2021
 */
if(!function_exists('pushNotification')) {
    function storeAndPushNotification($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, $url)
    {
        /* add notification to first Employee */
        $date = Carbon::now()->diffForHumans();
        $notification = new NewNotification($titleAr, $titleEn, $descriptionAr, $descriptionEn, $date, $icon, $color, $url);
        $admin = Employee::first();
        $admin->notify($notification);

        /* push notifications to all admins */
        $firebaseToken = Employee::whereNotNull('device_token')->pluck('device_token')->all();
        $SERVER_API_KEY = "AAAAo9l6yTw:APA91bGNwk_P5TA_kKt6_KnDadQHyZUL-rwWTRMIDLB115Z-iYPTP2etHCFlmfHoky8D0RwXJyRGdzfz70xr7AwyWj2qNiGiqwKznK2H8qLDGve0kdxn3aFxRHxCoBVV4OgZz6TGIp5y";

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "alert_title" => app()->isLocale('ar') ? $titleAr : $titleEn,
                "title_ar" => $titleAr,
                "title_en" => $titleEn,
                "description_ar" => $descriptionAr,
                "description_en" => $descriptionEn,
                "date" => $date,
                "alert_icon" => $icon,
                "icon" => asset('assets/dashboard/media/avatars/dorak.png'),
                "icon_color" => $color,
                "url" => $url,
                "id" => $admin->notifications->last()->id,
            ]
        ];

        return Http::withHeaders([
            "Authorization" => "key=$SERVER_API_KEY",
        ])->post('https://fcm.googleapis.com/fcm/send', $data);
    }


    if(!function_exists('OtpLink')){

        function OtpLink($phone,$otp)
        { 
        $apiUrl = "https://api.oursms.com/api-a/msgs";
        $token = "e4vHwxheBK6uujxk7G9I";
        $src = 'CODE CAR';
        $dests = "$phone";
        $appName = settings()->getSettings("website_name_" . getLocale()) ?? "CodeCar";

        $body = <<<msg
                مرحبًا بك في $appName ! رمز التسجيل: $otp
                شكرًا لك!
             msg;
                
        $response = \Illuminate\Support\Facades\Http::asForm()->post($apiUrl, [
            'token' => $token,
            'src' => $src,
            'dests' => $dests,
            'body' => $body,
        ]);

        

        if ($response->successful()) {
            // Request successful
            // echo "SMS sent successfully.";
        } else {
            // Request failed
            echo "Failed to send SMS. Error: " . $response->body();
        }
        }
    
    }
    
}

/** favourite functions **/
