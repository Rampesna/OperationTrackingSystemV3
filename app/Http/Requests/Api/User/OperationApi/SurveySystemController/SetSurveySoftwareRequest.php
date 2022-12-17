<?php

namespace App\Http\Requests\Api\User\OperationApi\SurveySystemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetSurveySoftwareRequest extends BaseApiRequest
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
            'id' => 'nullable|integer',
            'code' => 'required|string',
            'name' => 'required|string',
            'status' => 'required|integer',
        ];
    }
}
