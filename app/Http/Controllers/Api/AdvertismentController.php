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
            if($advent->total() > $advent->perPage()){
                $data =[
                    'recored'=>AdvertismentResource::collection($advent),
                    'pagination Links'=>[
                        'current page'=>$advent->currentPage(),
                        'per_page'=>$advent->perPage(),
                        'total_page'=>$advent->total(),
                        'links'=>[
                            'first'=>$advent->url(1),
                            'last'=>$advent->url($advent->lastPage()),
                        ],
                    ],
                ];
            }else{
                $data=AdvertismentResource::collection($advent);
            }
            return ApiResponse::SendResponse(200,'Advertisment Retrieved Successful',$data);
        }
        return ApiResponse::SendResponse(200,'No Advertisment Retrieved ',[]);

    }
    public function latest()  {
        $advent=Advertisement::latest()->take(2)->get();
        if(count($advent) > 0){
            return ApiResponse::SendResponse(200,'Latest Advertisement Retrieved',AdvertismentResource::collection($advent));
        }
            return ApiResponse::SendResponse(200,'They are not Latest Advertisement Retrieved',[]);

    }
}