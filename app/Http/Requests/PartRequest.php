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
        $datas = $this->request->all();
        $part_id = $datas['id'];
        $part = Part::where('id', $part_id)->first();

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => ['required', Rule::unique('parts', 'name')],
                        'serial_number' => ['required', 'regex:/([a-z|A-Z|0-9]{7,20})/', Rule::unique('parts', 'serial_number')],
                        'count' => ['required', 'regex:/(\d{1,})/'],
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
                        'count' => ['required', 'regex:/([0-9]{1,})/'],
                        'price' => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{2})?$/'],
                        'category_id' => ['required'],
                        'name' => ['required', Rule::unique('parts', 'name')->ignore($part['id'])],
                    ];
                }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'serial_number.unique' => 'Kod produktu już jest zajęty!',
            'serial_number.regex' => 'Zły kod produktu!',
            'name.unique' => 'Dana część już istnieje!',
            'count.regex' => 'Podaj poprawną ilość sztuk!',
            'price.regex' => 'Podaj poprawną cenę!',
        ];
    }
}
