<?php

namespace App\Validators;

use App\Constants\AppConstant;
use App\Constants\HTTPConstant;
use App\Helpers\ResponseHelper;
use Validator;
use Illuminate\Validation\Rule;

class TransactionValidator 
{
    public function validateGET($request)
    {
        
        $rules = [
            "from_date" => "date_format:Y-m-d",
            "to_date" => "date_format:Y-m-d",
            "value_min" => "numeric|between:0,999999999.99",
            "value_max" => "numeric|between:0,999999999.99",
            "transaction_type" => ["string", Rule::in(['cr', 'dr'])],
            "transaction_mode" => ["string", Rule::in(['upi', 'neft', 'imps', 'atm', 'other'])],
            "notes" => "string",
            "to_account_number" => "string",
            "to_account_name" => "string",
            "ref_transaction" => "string",
        ];

        $validation_message = [
            'from_date.date_format' => __('validation.date_format', ['attribute' => 'from_date', 'format' => 'YYYY-MM-DD']),
            'to_date.date_format' => __('validation.date_format', ['attribute' => 'to_date', 'format' => 'YYYY-MM-DD']),
		];
        $validator = Validator::make($request, $rules, $validation_message);
        $return = [];
        if ($validator->fails()) {
            $result['code'] = HTTPConstant::BAD_REQUEST;
            $result['message'] = __('message.'.$result['code']);
            $result['status'] =  AppConstant::VALIDATION_FAILED;
            $result['error'] = ResponseHelper::filterValidationMessage($validator->errors());
            return $result;
        }
        return true;
    }
}
