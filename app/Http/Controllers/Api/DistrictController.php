<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$city_id)
    {
        $District =District::where('city_id',$city_id)->get();
        if(count($District) > 0)
        {
            return ApiResponse::SendResponse(200,'Districts retrieved',DistrictResource::collection($District));
        }
        return ApiResponse::SendResponse(200,'Districts empty','[]');

    }
}
