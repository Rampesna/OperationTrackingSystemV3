<?php

namespace App\Http\Requests\Api\User\RecruitingController;

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
            'companyId' => 'required|integer',
            'departmentId' => 'required|integer',
            'name' => 'required|string',
            'identity' => 'required|string',
            'email' => 'required|string',
            'phoneNumber' => 'required|string',
            'obstacle' => 'required|integer',
            'birthDate' => 'required|date',
            'cv' => 'required|file',
            'filePath' => 'required|string',
        ];
    }
}
