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
use App\NonRegisterUsers;

Route::get('/', function () {

    $splitlist = NonRegisterUsers::all();
    return view('homepage',['splitlist'=>$splitlist]
    );
});

Route::get('/new',function (){
    return view('newSplitForm');
});


Route::post('/add/split/','NonRegisterUsersController@createSplit');
Route::post('/add/expense','NonRegisterUsersController@addExpense');


Route::get('/view/splits/{splitName}/{splitHash}','NonRegisterUsersController@splitDetails')->name('splitDetails');
Route::get('/view/expenses/{splitHash}','NonRegisterUsersController@viewAllExpense');
