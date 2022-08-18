<?php

namespace App\Http\Requests\Api\Employee\EmployeeController;

use App\Http\Requests\Api\BaseApiRequest;

class UpdatePasswordRequest extends BaseApiRequest
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
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ];
    }
}
