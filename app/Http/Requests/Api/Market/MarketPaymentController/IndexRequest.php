<?php

namespace App\Http\Requests\Api\Market\MarketPaymentController;

use App\Http\Requests\Api\BaseApiRequest;

class IndexRequest extends BaseApiRequest
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
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ];
    }
}
