<?php

namespace App\Http\Requests\Api\User\OperationSpecialReportController;

use App\Http\Requests\Api\BaseApiRequest;

class GetSpecialReportRequest extends BaseApiRequest
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
            'startDate' => 'required',
            'endDate' => 'required',
            'query' => 'required',
        ];
    }
}
