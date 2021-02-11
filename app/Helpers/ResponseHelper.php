<?php

namespace App\Helpers;

class ResponseHelper
{

    public static function format($response)
    {
        $return['code'] = $response['operation_code']??0;
        $return['message'] = __('messages.'.$return['code']);
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
        $response['http_code'] = $response['http_code']??0;
        return response($return, $response['http_code']);
    }

}