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

Route::get('/', 'FrontEndController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', 'FrontEndController@guest')->name('dashboard');

    Route::get('/estates/create', [
        'uses'=> 'EstateController@create',
        'as' => 'estate.create',
    ]);
    
    Route::post('/estates/store', [
        'uses'=> 'EstateController@store',
        'as' => 'estate.store',
    ]);
    Route::get('/estates/search', [
        'uses'=> 'EstateController@search',
        'as' => 'estate.search',
    ]);
    
    Route::get('/estates/index', [
        'uses'=> 'EstateController@index',
        'as' => 'estate.index',
    ]);
    
    Route::get('/estates/edit/{id}', [
        'uses'=> 'EstateController@edit',
        'as' => 'estate.edit',
    ]);

    Route::get('/estates/payment/{id}', [
        'uses'=> 'EstateController@create_payment',
        'as' => 'estate.payment',
    ]);
    Route::post('/estates/credit/{id}', [
        'uses'=> 'EstateController@store_credit',
        'as' => 'estate.credit',
    ]);
    
    Route::post('/estates/update/{id}', [
        'uses'=> 'EstateController@update',
        'as' => 'estate.update',
    ]);
    
    Route::post('/estates/payment/mark_paid/{id}', [
        'uses'=> 'EstateController@mark_paid_payment',
        'as' => 'estate.payment.mark_paid',
    ]);
    
    Route::post('/estates/payment/remove/{id}', [
        'uses'=> 'EstateController@remove_payment',
        'as' => 'estate.payment.remove',
    ]);
    Route::post('/estates/credit/remove/{id}', [
        'uses'=> 'EstateController@remove_credit',
        'as' => 'estate.credit.remove',
    ]);

    Route::post('/estates/add_payment/{id}', [
        'uses'=> 'EstateController@store_payment',
        'as' => 'estate.payment.add',
    ]);
    
    Route::get('/estates/destroy/{id}', [
        'uses'=> 'EstateController@destroy',
        'as' => 'estate.destroy',
    ]);

    Route::post('/estates/show', [
        'uses'=> 'EstateController@show',
        'as' => 'estate.show',
    ]);
    Route::get('/comments/create/{id}', [
        'uses'=> 'CommentsController@create',
        'as' => 'comment.create',
    ]);
    
    Route::get('/comments/delete/{id}', [
        'uses'=> 'CommentsController@destroy',
        'as' => 'comment.delete',
    ]);
    
    
    Route::post('/comments/store/{id}', [
        'uses'=> 'CommentsController@store',
        'as' => 'comment.store',
    ]);
    
    Route::get('/comments/edit/{id}', [
        'uses'=> 'CommentsController@edit',
        'as' => 'comment.edit',
    ]);
    
    Route::post('/comments/update/{id}', [
        'uses'=> 'CommentsController@update',
        'as' => 'comment.update',
    ]);
    
    Route::get('/letters/create/{id}', [
        'uses'=> 'LettersController@create',
        'as' => 'letter.create',
    ]);
    
    Route::get('/letters/delete/{id}', [
        'uses'=> 'LettersController@destroy',
        'as' => 'letter.delete',
    ]);
    
    
    Route::post('/letters/store/{id}', [
        'uses'=> 'LettersController@store',
        'as' => 'letter.store',
    ]);
    
    Route::get('/letters/edit/{id}', [
        'uses'=> 'LettersController@edit',
        'as' => 'letter.edit',
    ]);
    
    Route::post('/letters/update/{id}', [
        'uses'=> 'LettersController@update',
        'as' => 'letter.update',
    ]);




    Route::get('/accrequests/create/{id}', [
        'uses'=> 'AccrequestsController@create',
        'as' => 'accrequest.create',
    ]);
    
    Route::get('/accrequests/delete/{id}', [
        'uses'=> 'AccrequestsController@destroy',
        'as' => 'accrequest.delete',
    ]);
    
    Route::post('/accrequests/store/{id}', [
        'uses'=> 'AccrequestsController@store',
        'as' => 'accrequest.store',
    ]);
    
    Route::get('/accrequests/edit/{id}', [
        'uses'=> 'AccrequestsController@edit',
        'as' => 'accrequest.edit',
    ]);
    
    Route::post('/accrequests/update/{id}', [
        'uses'=> 'AccrequestsController@update',
        'as' => 'accrequest.update',
    ]);
    
    Route::get('/frontend/index', [
        'uses'=> 'FrontEndController@index',
        'as' => 'frontend.index',
    ]);
    
    Route::get('/frontend/create', [
        'uses'=> 'FrontEndController@create',
        'as' => 'frontend.create',
    ]);
    
    
    Route::get('/frontend/singlehouse/{id}', [
        'uses'=> 'FrontEndController@singlehouse',
        'as' => 'frontend.singlehouse',
    ]);

    Route::get('/report/{type}', [
        'uses' => 'EstateController@report',
        'as' => 'report',
    ]);
   
});


