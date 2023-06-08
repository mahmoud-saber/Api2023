<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewMessageRequest;

class MessageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(NewMessageRequest $request)
    {
        $data = $request->validated();
        $record = Message::create($data);

        if($record){
            return ApiResponse::SendResponse(201,'saved successful',[]);
        }
    }
}