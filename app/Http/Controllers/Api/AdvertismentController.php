<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertismentRequest;
use App\Http\Resources\AdvertismentResource;
use Illuminate\Http\Request;
use Spatie\FlareClient\Api;

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
    public function domain($domain_id)  {
        $advent=Advertisement::where('domain_id',$domain_id)->latest()->get();
        if(count($advent) > 0){
            return ApiResponse::SendResponse(200,'Tte latest Advertisement Retrieved in domain',AdvertismentResource::collection($advent));
        }
            return ApiResponse::SendResponse(200,'They are not Latest Advertisement Retrieved in domain',[]);

    }
    public function search(Request $request){
        // $word= $request->has('search') ? $request->input('search') : null;
        $word = $request->input('search') ?? null;
        $advent =Advertisement::when($word !=null,function($query) use ($word){
            $query->where('title','like','%'.$word.'%');
        })->latest()->get();

        if(count($advent) > 0){
            return ApiResponse::SendResponse(200,'Search Complete',AdvertismentResource::collection($advent));
        }
            return ApiResponse::SendResponse(200,'Search not matched',[]);
    }
    function create(AdvertismentRequest $request)  {
        $data=$request->validated();
        $data['user_id'] = $request->user()->id;
        $record=Advertisement::create($data);
        if($record){
            return ApiResponse::SendResponse(201,'create Ads successful', new AdvertismentResource($record));
        }
        return ApiResponse::SendResponse(200,'Not create Ads', []);

    }
}