<?php

use Illuminate\Http\Request;

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

Route::get('cities', 'City\CityController@findAll');

Route::get('members', 'Member\MemberController@findAll');
Route::get('members/{id}', 'Member\MemberController@findById');
Route::put('members/{member}', 'Member\MemberController@update');

Route::get('members/city/{id}', 'Member\MemberController@showListOfGuidesInCity');

Route::get('memberlanguages', 'Languages\MemberLanguagesController@findAll');
Route::get('memberlanguages/{memberId}', 'Languages\MemberLanguagesController@findById');
Route::get('languages', 'Languages\MemberLanguagesController@getLanguages');

Route::get('fees', 'Member\MemberController@getAllFees');

Route::post('login', 'Login\LoginController@doLogin');
Route::post('register', 'Login\LoginController@doLogin');

Route::get('group', 'Group\GroupController@findAll');
Route::get('group/{memberId}', 'Group\GroupController@getMemberGroupByMemberId');

Route::get('membergroup', 'Group\MemberGroupController@findAll');
