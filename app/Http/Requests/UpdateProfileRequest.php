<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdateProfileRequest extends FormRequest
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
            "firstName" => "string",
            "lastName" => "string",
            "nickName" => "string",
            "age" => "integer",
            "gender" => "string",
            // "country" => "required",
            "height" => "nullable",
            "weight" => "nullable",
            "personalInfo" => "nullable",
            "sexualOrientation" => "nullable",
            "lookingFor" => "string",
            "lookingDescription" => "string",
            "profileImagePath" => "image|mimes:jpeg,png,jpg,gif,svg",
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        if ($validator->fails()) {
            throw new HttpResponseException(response()
                    ->json(
                        [
                            "errors" => $validator->errors()->all(),
                        ],
                        Response::HTTP_UNPROCESSABLE_ENTITY
                    ));
        }
    }
}
