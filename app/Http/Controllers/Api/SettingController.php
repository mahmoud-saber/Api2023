<?php

namespace App\Http\Controllers\Api;

 use App\Models\Setting;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $settings=Setting::findOrFail(1);
        // return  new SettingResource($settings);

        // $settings=Setting::get();
        // return SettingResource::collection($settings);

         $settings = Setting::find(1);
        // $settings = Setting::find(3);
        if($settings){
            return ApiResponse::SendResponse(200,'Settings Retrieved successful',new SettingResource($settings));
        }
            return ApiResponse::SendResponse(200,'Settings not found','[]');

      }
}