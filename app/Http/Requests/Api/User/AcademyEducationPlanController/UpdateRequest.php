<?php

namespace App\Http\Requests\Api\User\AcademyEducationPlanController;

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
            'educationist' => 'required|string',
            'startDatetime' => 'required|date',
            'academyEducationPlanTypeId' => 'required|integer',
            'location' => 'required|string',
        ];
    }
}
