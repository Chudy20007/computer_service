<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $employee = User::where('id',$this->id)->get()->first();

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => ['required', 'regex:/^([A-ZĄĘĆŹŻŁŃ]{1}[a-ząęćńźżółu]{3,}\s[A-ZĄŃĘĆŹŁÓŻ]{1}[a-ząęńćźżół]{2,18})$/'],
                        'email' => ['required', 'email', Rule::unique('users', 'email')],
                        'password' => ['required'],
                        'phone' => ['required', 'regex:/^[0-9]{8,}$/', Rule::unique('users', 'phone')],
                        'role' => ['required', 'regex:/^([a-z]{4,})$/'],
                        'post-code' => ['required', 'regex:/^([0-9]{2})-([0-9]{3})$/'],
                        'local-number' => ['required'],
                        'file' => ['required'],
                        'street' => ['required'],

                        //
                    ];
                }
            case 'PUT':
                {
                    break;
                }
            case 'PATCH':
                {
                    return [
                        'name' => ['required', 'regex:/^([A-ZĄĘĆŹŁŻ]{1}[a-ząęćńźżół]{2,15}\s[A-ZĄĘŃĆŹŁÓŻ]{1}[a-ząńęćźżół]{2,15})$/'],
                        'email' => ['required', 'email', Rule::unique('users', 'name')->ignore($employee['id'])],
                        'password' => ['required'],
                        'phone' => ['required', 'regex:/^[0-9]{8,}$/', Rule::unique('users', 'phone')->ignore($employee['id'])],
                        'role' => ['required', 'regex:/^([a-z]{4,})$/'],
                        'post_code' => ['required', 'regex:/^([0-9]{2})-([0-9]{3})$/'],
                        'local_number' => ['required'],
                       // 'file' => ['required'],
                        'street' => ['required'],

                    ];
                }

            default:break;
        }

    }

    public function messages()
    {

        return [
            'name.regex' => 'Podaj poprawne imię i nazwisko!',
            'email.regex' => 'Podaj poprawny adres e-mail!',
            'phone.regex' => 'Podaj poprawny numer telefonu!',
            'post-code.regex' => 'Podaj poprawny kod pocztowy!',
            'role.regex' => "Podaj poprawną rolę!",

            'email.unique' => 'Podany e-mail jest już zajęty!',
            'phone.unique' => 'Numer telefonu jest już zajęty',
            

        ];

    }
}
