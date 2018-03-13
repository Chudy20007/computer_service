<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => ['required','regex:/^([A-Z]{1})[a-z]{2,}/'],
            'serial_number' => ['required','regex:/([a-z|A-Z|0-9]{7,20})/','unique:parts'],
            'count' => ['required','regex:/(\d{1,})/'],
            'price' => ['required','regex:/(\d{1,}).(\d{2})/'],      
            'category_id' => ['required']
            
        ];
    }

    
}