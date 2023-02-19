<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
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
        return [
//            'List_Classes.*.Name' => 'required',
//            'List_Classes.*.Name_class_en' => 'required',

            'List_Classes.*.Name' => 'required|unique:Classrooms,Name_Class->ar,Grade_id',
            'List_Classes.*.Name_class_en' => 'required|unique:Classrooms,Name_Class->en,Grade_id',

        ];
    }
    public function messages()
    {
        return [


        ];
    }
}
