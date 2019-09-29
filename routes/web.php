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

use Prophecy\Exception\Doubler\ClassCreatorException;

Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/new',function (){
    return view('newSplitForm');
});
Route::post('/add/split/','NonRegisterUsersController@createSplit');
Route::get('/splits/{splitName}/{splitHash}','NonRegisterUsersController@splitDetails')->name('splitDetails');

Route::post('/add/expense','NonRegisterUsersController@addExpense');
Route::get('/view/expenses/{splitHash}','NonRegisterUsersController@viewAllExpense');
