<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/transaction-history', function (Request $request) {
    return $request->transaction();
});

Route::post('/transaction-history', function (Request $request) {
    return $request->transaction();
});

$router->group([], function () use ($router)
{
	$router->get('/transaction-history', ['uses' => 'TransactionController@get']);
});

