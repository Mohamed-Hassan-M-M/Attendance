<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'firstname'=>'required',
            'lastname'=>'required',
            'mobile'=>'required|unique:employees,mobile',
            'barcode'=>'required|unique:employees,barcode',
            'email'=>'nullable|unique:employees,email',
            'department_id'=>'required|exists:departments,id',
        ];
    }

}
