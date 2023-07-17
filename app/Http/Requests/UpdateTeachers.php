<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeachers extends FormRequest
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
            'Email' => 'required|unique:teachers,Email,'.$this->id,
            'Password' => 'required',
            'specialization' => 'required',
            'gender' => 'required',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Email.required' => trans('validation.required'),
            'Email.unique' => trans('validation.unique'),
            'Password.required' => trans('validation.required'),
            'specialization.required' => trans('validation.required'),
            'gender.required' => trans('validation.required'),
            'Joining_Date.required' => trans('validation.required'),
            'address.required' => trans('validation.required'),
        ];
    }
}
