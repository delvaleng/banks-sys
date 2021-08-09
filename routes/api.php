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

Route::middleware(['auth:api'])->group(function () {

  Route::get('getTpAccount',       'TpAccountController@index');
  Route::get('getTpBanks',         'TpBanksController@index');
  Route::get('account/me',         'AccountOwnController@me');
  Route::get('account/get',        'AccountOwnController@get');
  Route::get('account/other',      'AccountOwnController@other');
  Route::post('/transfer/create',  'TranferOwnController@create');
  Route::post('/transfer/list',    'TranferOwnController@index');
});
