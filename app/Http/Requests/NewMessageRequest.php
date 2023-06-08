<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class NewMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {

        if($this->is('api/*'))
        {
            $response =ApiResponse::SendResponse(422,'Validation Error',$validator->errors());
            // $response =ApiResponse::SendResponse(422,'Validation Error',$validator->messages()->all());
            throw new ValidationException($validator,$response);
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'message'=>'nullable'
        ];
    }

    public function attributes()
    {
        return[
            'name'=>'Name',
            'email'=>'Email',
            'phone'=>'Phone',
            'message'=>'Message',
        ];
    }
}
