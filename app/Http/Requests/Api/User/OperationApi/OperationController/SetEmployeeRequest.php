<?php

namespace App\Http\Requests\Api\User\OperationApi\OperationController;

use App\Http\Requests\Api\BaseApiRequest;

class SetEmployeeRequest extends BaseApiRequest
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
            'companyId' => 'required',
            'email' => 'required|email',
//            'username' => 'required',
//            'password' => 'required',
            'name' => 'required',
//            'assignment' => 'required',
//            'education' => 'required',
            'webCrmUserId' => 'required',
            'webCrmUsername' => 'required',
            'webCrmUserPassword' => 'required',
            'progressCrmUsername' => 'required',
            'progressCrmPassword' => 'required',
            'role' => 'required',
            'groupCode' => 'required',
            'teamCode' => 'required',
//            'teamLead' => 'required',
//            'teamLeadAssistant' => 'required',
            'callScanCode' => 'required',
            'santralCode' => 'required',
//            'uyumSatisApiCrmUserName' => 'required',
//            'uyumSatisApiCrmUserPassword' => 'required',
        ];
    }
}
