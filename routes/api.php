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

Route::get('members/notin/{id}', 'Member\MemberController@membersNotIn');

// code here for selecting those groups, that current user does not have in previous list
Route::get('members/notin/group/{id}', 'Member\MemberController@userNotInGroup');
// code here for select all languages that are not spoken by the member
Route::get('members/notin/languages/{id}', 'Member\MemberController@userNotInLanguages');

Route::get('memberlanguages', 'Languages\MemberLanguagesController@findAll');
Route::get('memberlanguages/{memberId}', 'Languages\MemberLanguagesController@findById');

Route::get('languages', 'Languages\MemberLanguagesController@getLanguages');
Route::post('languages', 'Languages\MemberLanguagesController@addLanguage');
Route::delete('languages/{language}', 'Languages\MemberLanguagesController@deleteLanguage');

// Show the payment fees
Route::get('fees', 'Member\MemberController@getAllFees');
Route::post('fees', 'Member\MemberController@addFees');
Route::put('fees/{fee}', 'Member\MemberController@updateFees');
Route::delete('fees/{fee}', 'Member\MemberController@deleteFees');
// Shows payment for the year
Route::get('fees/{year}', 'Member\MemberController@getFeesForCurrentYear');

Route::post('login', 'Login\LoginController@doLogin');
Route::post('register', 'Login\RegisterController@register');

Route::get('group', 'Group\GroupController@findAll');
Route::get('group/{memberId}', 'Group\GroupController@getMemberGroupByMemberId');

Route::get('membergroup', 'Group\MemberGroupController@findAll');

