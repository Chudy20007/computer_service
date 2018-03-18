<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                        'name' => ['required', 'regex:/^([A-Z]{1}[a-z]{3,})$/', 'unique:categories'],
                    ];
                }
            case 'PUT':
                {
                    break;
                }
            case 'PATCH':
                {
                    return [

                        'name' => ['required', 'regex:/^([A-Z]{1}[a-z]{3,})$/', Rule::unique('categories', 'name')->ignore($category['id'])],

                    ];
                }

            default:break;
        }

    }
}
