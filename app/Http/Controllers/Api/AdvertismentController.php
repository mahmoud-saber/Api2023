<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertismentResource;
use Illuminate\Http\Request;

class AdvertismentController extends Controller
{
    public function index(){
        $advent=Advertisement::latest()->paginate(1);
        if(count($advent) > 0){
            return ApiResponse::SendResponse(200,'Advertisment Retrieved Successful',AdvertismentResource::collection($advent));
        }
        return ApiResponse::SendResponse(200,'No Advertisment Retrieved ',[]);

    }
}