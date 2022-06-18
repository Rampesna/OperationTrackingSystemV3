<?php

namespace App\Http\Requests\Api\User\OperationApi\JobsSystemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetJobsClosedExcelRequest extends BaseApiRequest
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
            'file' => 'required|file|mimes:xls,xlsx',
            'commercialCompanyId' => 'required',
        ];
    }
}
