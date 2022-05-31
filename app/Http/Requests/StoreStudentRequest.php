<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
            'regno' => 'required|unique:students,regno',
            'accessno' => 'nullable|unique:students,accessno',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'other_name' => 'nullable|min:3',
            'dob' => 'required|date',
            'photo' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'sex' => 'required',
            'religion' => 'nullable',
            'marital_status' => 'nullable',
            'nationlity' => 'nullable',
            'email' => 'nullable|email'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
