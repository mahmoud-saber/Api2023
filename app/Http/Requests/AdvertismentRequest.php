<?php

namespace App\Http\Requests;
use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class AdvertismentRequest extends FormRequest
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
            'title'=>'required',
            'phone'=>'required',
            'text'=>'required',
            'domain_id'=>'required|exists:domains,id',

        ];
    }


    public function attributes()
    {
        return[
            'title'=>'Title',
            'phone'=>'Phone',
            'text'=>'Description',
            'domain_id'=>'Domain',
        ];
    }
}