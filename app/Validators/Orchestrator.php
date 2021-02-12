<?php

namespace App\Validators;

use Validator;
use Illuminate\Http\Request;
use App\Constants\AppConstant;
use App\Constants\HTTPConstant;
use App\Helpers\ResponseHelper;

class Orchestrator
{
    const MODULE_VALIDATION_CLASS_POSTPEND = "Validator";
    const MODULE_VALIDATION_CLASS_PREPEND = "App\\Validators\\";

    protected $type_of_flow, $request_method;

    public function __construct($type_of_flow, $request_method){
        $this->type_of_flow = $type_of_flow;
        $this->request_method = $request_method;
    }

    public function validate($request_data)
    {
        $result = [];
        $condition = [
            "account_id" => "required",
        ];
        $error_message = [
            "account_id.required" => __("validation.required", ["attribute" => "account_id"]),
        ];

        $validator = Validator::make($request_data, $condition, $error_message);
        
        if ($validator->fails()) 
        {
            $result["code"] = HTTPConstant::BAD_REQUEST;
            $result["message"] = __("message.".$result["code"]);
            $result["status"] =  AppConstant::VALIDATION_FAILED;
            $result["error"] = ResponseHelper::filterValidationMessage($validator->errors());
            return $result;
        } else if($this->type_of_flow != "") {
            $validation_class_name =  self::MODULE_VALIDATION_CLASS_PREPEND . ucfirst($this->type_of_flow) . self::MODULE_VALIDATION_CLASS_POSTPEND;
            $validation_obj = new $validation_class_name();
            if(method_exists($validation_obj, "validate".$this->request_method)) {
                return $validation_obj->{"validate".$this->request_method}($request_data);
            }
            return true;
        }

    }
}