<?php

namespace App\Http\Requests\Api\User\OperationApi\SurveySystemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetSurveyRequest extends BaseApiRequest
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
            'id' => 'nullable',
            'code' => 'required|integer',
            'name' => 'required|string',
            'description' => 'nullable',
            'customerInformation1' => 'nullable',
            'customerInformation2' => 'nullable',
            'serviceProduct' => 'nullable',
            'callReason' => 'required|string',
            'opportunity' => 'required|integer',
            'call' => 'required|integer',
            'dialPlan' => 'required|integer',
            'opportunityRedirectToSeller' => 'required|integer',
            'dialPlanRedirectToSeller' => 'required|integer',
            'additionalProductOpportunity' => 'required|integer',
            'additionalProductCallPlan' => 'required|integer',
            'sellerRedirectionType' => 'required|integer',
            'emailTitle' => 'nullable',
            'emailContent' => 'nullable',
//            'jobResource' => 'required|string',
            'listCode' => 'nullable',
            'status' => 'required|string',
            'callList' => 'nullable',
        ];
    }
}
