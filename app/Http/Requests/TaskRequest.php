<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
    protected $redirectTo = '/';
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function rules()
    {
        $task = Task::find($this)->first();

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'title' => ['required', 'regex:/([A-Z]{1}[a-z]{3,})/'],
                        'message' => ['required'],
                        'order_id' => ['required'],
                    ];
                }
            case 'PUT':
                {
                    break;
                }
            case 'PATCH':
                {
                    return [
                        'title' => ['required', 'regex:/([A-Z]{1}[a-z]{3,})/'],
                        'message' => ['required'],
                    ];
                }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'title.regex' => 'Podaj poprawny tytuł!',
            'title.required' => 'Podaj tytuł!',
            'message.required' => 'Podaj treść wiadomości!',
            'order_id.required' => 'Podaj numer zlecenia!',
            'employee_id.required' => 'Wybierz pracownika!',
        ];
    }
}
