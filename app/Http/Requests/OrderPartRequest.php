<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderPartRequest extends FormRequest
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
                    'order_id' => ['required'],
                    'part_id' => ['required',Rule::unique('order_parts', 'part_id')->where('order_id',$this->order_id)]
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
                    'part_id' => ['required',Rule::unique('services', 'service_id')->ignore($order_service['id'])],
            
                ];
            }
            
            default:break;
        }
        
    }
    public function messages()
    {
     
            return [
                'part_id.required' => 'Pole z częścią jest wymagane!',
                'order_id.required' => 'Pole ze zleceniem jest wymagane!'             
            ];
        
    }
}
