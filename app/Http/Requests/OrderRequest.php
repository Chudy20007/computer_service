<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'regex:/^([A-Z]{1}[a-z]{2,15}\s[A-Z]{1}[a-z]{2,15})$/'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/^[0-9]{8,}$/'],
            'device' => ['required'],
            'post-code' => ['required', 'regex:/^([0-9]{2})-([0-9]{3})$/'],
            'local-number' => ['required'],
            'description' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Podaj poprawne imię i nazwisko!',
            'email.regex' => 'Podaj poprawny adres e-mail!',
            'phone.regex' => 'Podaj poprawny numer telefonu!',
            'post-code.regex' => 'Podaj poprawny kod pocztowy!',
        ];
    }
}
