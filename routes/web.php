<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//public pages
Route::get('/home/personal/', 'UserController@personalIndex')->name('personalIndex');
Route::get('/home/transliterate/', 'HomeController@transliterateIndex')->name('transliterateIndex');
Route::get('/home/docusign/', 'HomeController@docusignIndex')->name('docusignIndex');
Route::get('/home/cardcheck/', 'HomeController@cardcheckIndex')->name('cardcheckIndex');
Route::get('/home/underwriting/', 'HomeController@underwritingIndex')->name('underwritingIndex');
Route::get('/home/terroristscheck/', 'HomeController@terroristscheckIndex')->name('terroristscheckIndex');
Route::get('/home/fssp/', 'HomeController@fsspIndex')->name('fsspIndex');
Route::get('/home/employer/', 'HomeController@employerIndex')->name('employerIndex');
Route::get('/home/employer2/', 'HomeController@employer2Index')->name('employer2Index');

//service pages
Route::get('/bins/', 'BinsController@index')->name('binsIndex');
Route::get('/finCodes/', 'FinCodesController@index')->name('finCodesIndex');
Route::get('/regionCodes/', 'RegionCodesController@index')->name('regionCodesIndex');
Route::get('/terrorists/', 'TerroristsController@index')->name('terroristsIndex');
Route::get('/home/letters/', 'HomeController@lettersIndex')->name('lettersIndex');
Route::get('/okopf/', 'OkopfController@index')->name('okopfIndex');

//ajax scripts
Route::get('/docusignAjax/', 'HomeController@docusignAjax')->name('docusignAjax');
Route::get('/nameCheckAjax/', 'HomeController@nameCheckAjax')->name('nameCheckAjax');
Route::get('/underwritingPersonAjax/', 'HomeController@underwritingPersonAjax')->name('underwritingPersonAjax');
Route::get('/findIpAjax/', 'HomeController@findIpAjax')->name('findIpAjax');
Route::get('/underwritingCompanyAjax/', 'HomeController@underwritingCompanyAjax')->name('underwritingCompanyAjax');
Route::get('/personReadMoreAjax/', 'HomeController@personReadMoreAjax')->name('personReadMoreAjax');
Route::get('/companyReadMoreAjax/', 'HomeController@companyReadMoreAjax')->name('companyReadMoreAjax');
Route::get('/companyFinancicalAjax/', 'HomeController@companyFinancicalAjax')->name('companyFinancicalAjax');
Route::get('/terroristCheckAjax/', 'TerroristsController@terroristCheckAjax')->name('terroristCheckAjax');
Route::get('/cardcheckAjax/', 'BinsController@cardcheckAjax')->name('cardcheckAjax');
Route::get('/fsspPersonAjax/', 'HomeController@fsspPersonAjax')->name('fsspPersonAjax');
Route::get('/fsspPersonStatusAjax/', 'HomeController@fsspPersonStatusAjax')->name('fsspPersonStatusAjax');
Route::get('/fsspPersonResultAjax/', 'HomeController@fsspPersonResultAjax')->name('fsspPersonResultAjax');
Route::get('/emp2FindPersonAjax/', 'HomeController@emp2FindPersonAjax')->name('emp2FindPersonAjax');
Route::get('/emp2FindCompanyAjax/', 'HomeController@emp2FindCompanyAjax')->name('emp2FindCompanyAjax');

//update scripts
Route::post('/home/letters/update/', 'HomeController@lettersUpdate')->name('lettersUpdate');
Route::put('/home/personal/update/', 'UserController@personalUpdate')->name('personalUpdate');

//parsing scripts
Route::get('/getBins/', 'BinsController@getBins')->name('getBins');
Route::get('/getFinCodes/', 'FinCodesController@getFinCodes')->name('getFinCodes');
Route::get('/getTerrorists/', 'TerroristsController@getTerrorists')->name('getTerrorists');
Route::get('/getRegionCodes/', 'RegionCodesController@getRegionCodes')->name('getRegionCodes');
Route::get('/getOkopf/', 'OkopfController@getOkopf')->name('getOkopf');