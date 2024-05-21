<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>['numeric'],
            "firstName" => "required|string",
            "lastName" => "required|string",
            "nickName" => "required|string",
            "age" => "required",
            "gender" => "required|string",
            "country" => "required",
            "height" => "nullable",
            "weight" => "nullable",
            "personalInfo" => "nullable",
            "sexualOrientation" => "nullable",
            "lookingFor" => "required|string",
            "lookingDescription" => "required|string",
            "profileImagePath" => ['nullable'],
            // 'profileAttachments.*' =>'image|mimes:jpeg|,png|jpg|gif|max:2024', // Adjust the max file size and allowed MIME types as needed
            
        ];
    }
    protected function prepareForValidation()
    {
        //  check if the user is authenticated
        if(auth()->check()){
            $this->merge([
                'user_id'=>auth()->user()->id
            ]);
        }
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json($validator->errors(), 422));
    }

}
