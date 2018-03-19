<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','regex:/^([A-Z]{1}[a-z]{2,15}\s[A-Z]{1}[a-z]{2,15})$/'],
            'email' => ['required','email'],
            'phone' => ['required','regex:/^[0-9]{8,}$/'],
            'device' => ['required'],
            'post-code' =>['required','regex:/^([0-9]{2})-([0-9]{3})$/'],
            'local-number' => ['required'],
            'description' => ['required']
                 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name to create order is required',
            'email.required'  => 'A email is required to create order is required',
            'phone.required'  => 'A phone is required to create order is required',
        ];
    }
}
