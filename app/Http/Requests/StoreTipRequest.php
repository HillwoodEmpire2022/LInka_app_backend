<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipRequest extends FormRequest
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
            //
            'user_id'=>['numeric'],
            'tip_title'=>'required|string',
            'image'=>'nullable',
            'description'=>'required|string'
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
