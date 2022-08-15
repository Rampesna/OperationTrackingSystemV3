<?php

namespace App\Http\Requests\Api\Employee\OperationApi\PersonReportController;

use App\Http\Requests\Api\BaseApiRequest;

class GetPersonPenaltiesDetailsRequest extends BaseApiRequest
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
            //
        ];
    }
}
