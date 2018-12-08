<?php

namespace App\Http\Requests;

use App\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $service = Service::find($this)->first();

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'price' => ['required', 'regex:/(\d{1,}).(\d{2})/'],
                        'name' => ['required', Rule::unique('services', 'name')],
                    ];
                }
            case 'PUT':
                {
                    break;
                }
            case 'PATCH':
                {
                    return [
                        'price' => ['required', 'regex:/(\d{1,}).(\d{2})/'],
                        'name' => ['required', Rule::unique('services', 'name')->ignore($service['id'])],
                    ];
                }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'price.regex' => 'Podaj poprawną cenę!',
            'name.unique' => 'Dana usługa już istnieje!',
        ];
    }
}
