<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ResponseController extends Controller
{
    public function sendResponse($response)
    {
        $json = json_encode($response);
        $decode = json_decode($json,true);
       array_walk_recursive($decode,function(&$item){
            if($item == null){
            $item=strval($item);
            }
             if($item == '1' || $item == '0'){
                $item = intval($item);
            }

        });

        return response()->json($decode, 200);
    }


    public function sendError($error, $code = 404)
    {
    	$response = [
            'error' => $error,
        ];
        $response['status'] =  0;
        return response()->json($response, $code);
    }
}
