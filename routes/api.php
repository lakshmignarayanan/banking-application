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

$router->group(['middleware' => ['validation']], function () use ($router)
{
    $router->get('/transaction-history', ['as' => 'transaction', 'uses' => 'TransactionController@get']);
    $router->post('/transaction-history', ['as' => 'transaction', 'uses' => 'TransactionController@post']); //to handle more filters
});