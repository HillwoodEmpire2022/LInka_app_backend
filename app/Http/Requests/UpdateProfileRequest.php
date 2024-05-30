<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $profile = $this->route('profile');
        // return $profile->user_id == Auth::id();
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
            'firstName' => 'string',
            "lastName" => "string",
            "nickName" => "string",
            "age" => "string",
            "gender" => "string",
            "country" => "string",
            "height" => "nullable",
            "weight" => "string",
            "personalInfo" => "string",
            "sexualOrientation" => "string",
            "lookingFor" => "string",
            "lookingDescription" => "string",
            "profileImagePath" => ['nullable'],
            
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
    
    
}
