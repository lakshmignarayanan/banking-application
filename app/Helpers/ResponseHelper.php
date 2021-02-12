<?php

namespace App\Helpers;

class ResponseHelper
{

    public static function format($response)
    {
        $return['code'] = $response['code']??500; //let's assume the worst in fallback case - when code is not set
        $return['message'] = __('message.'.$return['code']);
        $return['data'] = [];
        if(isset($response['data']) && gettype($response['data'] == 'array'))
        {
            $return['data'] = $response['data'];
        }
        $return['error'] = (object)[];
        if(isset($response['error']) && (gettype($response['error']) === 'array'|| gettype($response['error']) === 'object'))
        {
            $return['error'] = (object)$response['error'];
        }
        $return['total'] = 0;
        if(isset($response['total']))
        {
            $return['total'] = $response['total'];
        }
        if(isset($response['limit']))
        {
            $return['limit'] = $response['limit'];
        }
        if(isset($response['offset']))
        {
            $return['offset'] = $response['offset'];
        }
        return response($return, $return['code']);
    }

    public static function filterValidationMessage($validationMessages)
    {
        $newArray = [];
        $validationMessagesArray = $validationMessages->toArray();
        if (!is_array($validationMessagesArray) || count($validationMessagesArray) <= 0) {
            return (object)[];
        }
        foreach ($validationMessagesArray as $key => $value) {
            $newArray[$key] = $value[0]??"";
        }
        return  $newArray;
    }

}