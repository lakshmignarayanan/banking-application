<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Validators\Orchestrator;
use App\Constants\AppConstant;

class ValidationMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		$request->merge($request->json()->all());
        $routeName = "";
		if(!empty($request->route()->action["as"])) {
			$routeName = $request->route()->action["as"];
		}
		
		$data = $request->all();
		$validationObject = new Orchestrator($routeName, $request->method());
        $validation_result = $validationObject->validate($data);
		if (isset($validation_result["status"]) && $validation_result["status"] == AppConstant::VALIDATION_FAILED)
		{
            unset($validation_result["status"]);
            return ResponseHelper::format($validation_result);
		}
		return $next($request);
	}

}