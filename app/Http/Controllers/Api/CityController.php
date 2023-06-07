<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use Spatie\FlareClient\Api;

class CityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
    $cities=City::all();
    if(count($cities) > 0){
        return ApiResponse::SendResponse(200,'city successful',CityResource::collection($cities));
    }
    return ApiResponse::SendResponse(200,'city empty','[]');

    }
}
