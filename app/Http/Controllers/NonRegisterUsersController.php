<?php

namespace App\Http\Controllers;

use App\NonRegisterUsers;
use Illuminate\Http\Request;
use Prophecy\Exception\Doubler\ClassCreatorException;

class NonRegisterUsersController extends Controller
{
    //
    public function createSplit (Request $request)
    {
        $validatedData =$request->validate([
            'data.split_name'=>'required|max:255|min:3',
            'data.creator_name'=>'required|max:255|min:3',
            'data.creator_email'=>'required|max:255',
            'data.shareMates'=>'required|min:1',
            'data.shareMates.*'=>'required',
        ]);

          $newSplit = NonRegisterUsers();
          $newSplit->creator_name = request('data.creator_name');
          $newSplit->split_name = request('data.split_name');
          $newSplit->creator_email = request('data.creator_email');
          $shareMates = request('data.shareMates');
          $newString = implode(',', $shareMates);
          $newSplit->all_contributers = $newString;
          $newString->localHash = $newString->generateHash();

            $newSplit->save();

          return $newSplit;


    }





}
