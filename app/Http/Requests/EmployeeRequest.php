<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\User;

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
        $employee = User::find($this)->first();

      
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => ['required','regex:/^([A-Z]{1}[a-z]{2,15}\s[A-Z]{1}[a-z]{2,15})$/'],
                    'email' => ['required','email',Rule::unique('users', 'email')],
                    'password' => ['required'],
                    'phone' => ['required','regex:/^[0-9]{8,}$/',Rule::unique('users', 'phone')],
                    'role' => ['required','regex:/^([a-z]{4,})$/'],
                    'post-code' =>['required','regex:/^([0-9]{2})-([0-9]{3})$/'],
                    'local-number' => ['required'],
                    'file' =>['required'],
                    'street' =>['required']
        
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
                    'name' => ['required','regex:/^([A-Z]{1}[a-z]{2,15}\s[A-Z]{1}[a-z]{2,15})$/'],
                    'email' => ['required','email',Rule::unique('users', 'name')->ignore($employee['id'])],
                    'password' => ['required'],
                    'phone' => ['required','regex:/^[0-9]{8,}$/',Rule::unique('users', 'phone')->ignore($employee['id'])],
                    'role' => ['required','regex:/^([a-z]{4,})$/'],
                    'post-code' =>['required','regex:/^([0-9]{2})-([0-9]{3})$/'],
                    'local-number' => ['required'],
                    'file' =>['required'],
                    'street' =>['required']
        
                ];
            }
            
            default:break;
        }
       
    }
}
