<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderServiceRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'order_id' => ['required'],
                        'service_id' => ['required', Rule::unique('order_services', 'service_id')->where('order_id', $this->order_id)],
                    ];
                }
            case 'PUT':
                {
                    break;
                }
            case 'PATCH':
                {
                    return [
                        'order_id' => ['required'],
                        'service_id' => ['required', Rule::unique('services', 'service_id')->ignore($order_service['id'])],
                    ];
                }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'service_id.unique' => "Dana usługa jest już przypisana do zlecenia!",
        ];
    }
}
