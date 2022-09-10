<?php

namespace App\Http\Requests\Api\Employee\EmployeeController;

use App\Http\Requests\Api\BaseApiRequest;

class RegisterRequest extends BaseApiRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required',
        ];
    }
}
