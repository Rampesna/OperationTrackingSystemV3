<?php

namespace App\Http\Requests\Api\User\PrCritterController;

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
            'name' => 'required|string',
            'minTarget' => 'required|numeric',
            'maxTarget' => 'required|numeric',
            'defaultTarget' => 'required|numeric',
            'minTargetPercent' => 'required|numeric',
            'maxTargetPercent' => 'required|numeric',
            'defaultTargetPercent' => 'required|numeric',
            'generalPercent' => 'required|numeric',
        ];
    }
}
