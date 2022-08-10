<?php

namespace App\Http\Requests\Api\User\PurchaseItemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetByPurchaseIdRequest extends BaseApiRequest
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
            'purchaseId' => 'required|integer',
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.requestedQuantity' => 'required|integer',
        ];
    }
}
