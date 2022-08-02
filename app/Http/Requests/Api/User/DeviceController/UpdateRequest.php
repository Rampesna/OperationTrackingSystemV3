<?php

namespace App\Http\Requests\Api\User\DeviceController;

use App\Http\Requests\Api\BaseApiRequest;

class UpdateRequest extends BaseApiRequest
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
            'id' => 'required|integer',
            'companyId' => 'required|integer',
            'categoryId' => 'required|integer',
            'statusId' => 'required|integer',
            'name' => 'nullable|string',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'serialNumber' => 'nullable|string',
            'ipAddress' => 'nullable|string',
        ];
    }
}
