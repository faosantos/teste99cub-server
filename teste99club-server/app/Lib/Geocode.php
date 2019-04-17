<?php

namespace App\Lib;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Grimzy\LaravelMysqlSpatial\Types\Point;

use Exception;

class Geocode 
{

   public static function getPointFromAddress($address)
   {
        $curl = curl_init();
        $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyDNWmWzQ0rSar3i4Dc59jWrGUND3NNEhX8&sensor=false&address=" . http_build_query([$address]);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        
        Log::info(curl_error($curl));
        $result = json_decode($result);
        $result = $result->results[0];

        curl_close($curl);
        return new Point($result->geometry->location->lat, $result->geometry->location->lng);
   }
  
}
