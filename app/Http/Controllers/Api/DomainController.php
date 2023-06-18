<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
 use App\Models\Domain;
use App\Http\Controllers\Controller;
use App\Http\Resources\DomainResource;

class DomainController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $Domain = Domain::all();
        if(count($Domain) > 0)
        {
            return ApiResponse::SendResponse(200,'Retrieved data successful',DomainResource::collection($Domain));
        }
            return ApiResponse::SendResponse(200,'Not Found',[]);

    }
}