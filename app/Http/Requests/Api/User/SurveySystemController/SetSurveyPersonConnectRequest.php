<?php

namespace App\Http\Requests\Api\User\SurveySystemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetSurveyPersonConnectRequest extends BaseApiRequest
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
            'surveyCode' => 'required',
            'guids' => 'required|array',
        ];
    }
}
