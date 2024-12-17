<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
 public static function Out($status,$data,$code):JsonResponse{
   return  response()->json(['status' => $status, 'data' =>  $data],$code);
 }
}
