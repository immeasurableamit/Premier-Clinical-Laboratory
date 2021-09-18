<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeePostRequest extends FormRequest
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
        if (\Request::route()->getName() == 'admin.employess.store') {
            return [
                'name' => 'required',
                'email' => [
                    'required',
                    Rule::unique('employees')->where('is_delete', 0)
                ],
                'phone' => 'required',
                'site' => 'required',
                'image' => 'required',
            ];
        } else {
            return [
                'name' => 'required',
                // 'days' => 'required',
                'email' => [
                    'required',
                    Rule::unique('employees')->ignore(request()->id, 'id')->where('is_delete', 0)
                ],
                'phone' => 'required',
                'image' => 'mimes:png,jpg',
            ];
        }
    }
}
