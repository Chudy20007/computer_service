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
                    'title' => ['required','regex:/([A-Z]{1}[a-z]{3,})/'],
                    'message' => ['required']
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
                    'title' => ['required','regex:/([A-Z]{1}[a-z]{3,})/'],
                    'message' => ['required']
                    
            
                ];
            }
            
            default:break;
        }
       
    }
}
