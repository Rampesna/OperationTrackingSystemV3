<?php

namespace App\Http\Requests\Api\User\EmployeeController;

use App\Http\Requests\Api\BaseApiRequest;

class CreateRequest extends BaseApiRequest
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
            'guid' => 'nullable',
            'companyId' => 'required|integer',
            'roleId' => 'required|integer',
            'jobDepartmentId' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|string',
            'santralCode' => 'nullable|string',
            'password' => 'required|string',
        ];
    }
}
