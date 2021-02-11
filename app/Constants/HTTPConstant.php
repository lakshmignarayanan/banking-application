<?php

namespace App\Constants;

/**
 * Final class to maintain all HTTP status constants that can be used across the service
 */
final class HTTPConstant {

    //HTTP status codes. refer - https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    const OK = 200;
    const RESOURCE_CREATED = 201; //for sync requests
    const REQUEST_ACCEPTED = 202; //for async requests

    const RESOURCE_NOT_MODIFIED = 304; //for any request that hasn't changed anything in the system
    
    const BAD_REQUEST = 400; //validation errors like missing params, invalid email
    const UNAUTHORIZED = 401;  //unauthorized. the client is unknown to the server
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403; //unauthorized but the client is known to the server
    const RESOURCE_NOT_FOUND = 404; // when the requested resource is not found
    const RESOURCE_CONFLICT = 409; //when request parameters are repeated or a resource conflict is encountered
    const UNSUPPORTED_MEDIA = 415;

    const APPLICATION_ERROR = 500;
    const METHOD_NOT_IMPLEMENTED = 501;
    const SERVICE_UNAVAILABLE = 503;
    
}