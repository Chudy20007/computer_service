<?php

namespace App\Http\Requests;

use App\Part;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartRequest extends FormRequest
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
        $part = Part::find($this)->first();

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {

                    return [
                        'name' => ['required', Rule::unique('parts', 'name'),
                        ],
                        'serial_number' => ['required', 'regex:/([a-z|A-Z|0-9]{7,20})/', Rule::unique('parts', 'name'),
                        ], 'count' => ['required', 'regex:/(\d{1,})/'],
                        'price' => ['required', 'regex:/(\d{1,}).(\d{2})/'],
                        'category_id' => ['required'],

                    ];
                }
            case 'PUT':
                {
                    break;
                }
            case 'PATCH':
                {

                    return [
                        'serial_number' => ['required', 'regex:/([a-z|A-Z|0-9]{7,20})/', Rule::unique('parts', 'serial_number')->ignore($part['id'])],
                        'count' => ['required', 'regex:/(\d{1,})/'],
                        'price' => ['required', 'regex:/(\d{1,}).(\d{2})/'],
                        'category_id' => ['required'],
                        'name' => ['required', Rule::unique('parts', 'name')->ignore($part['id'])],

                    ];
                }

            default:break;
        }

    }

}
