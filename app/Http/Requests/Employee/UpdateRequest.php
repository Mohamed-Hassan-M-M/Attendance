<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'firstname_ar'=>'required',
            'lastname'=>'required',
            'lastname_ar'=>'required',
            'address'=>'required',
            'address_ar'=>'required',
            'mobile'=>'required|unique:employees,mobile,'.$this->id,
            'barcode'=>'required|unique:employees,barcode,'.$this->id,
            'email'=>'nullable|unique:employees,email,'.$this->id,
            'department_id'=>'required|exists:departments,id',
        ];
    }

}
