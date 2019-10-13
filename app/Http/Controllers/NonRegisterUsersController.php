<?php

namespace App\Http\Controllers;

use App\Expenses;
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

          $newSplit = new NonRegisterUsers;
          $newSplit->creator_name = request('data.creator_name');
          $newSplit->split_name = request('data.split_name');
          $newSplit->creator_email = request('data.creator_email');
          $shareMates = request('data.shareMates');
          $newString = implode(',', $shareMates);
          $newSplit->all_contributers = $newString;
          $newSplit->localHash = $newSplit->generateHash();

            $newSplit->save();

            return $newSplit;
//          return redirect()->route(
//              'splitDetails',
//                    [
//                        'splitName'=>$newSplit->split_name,
//                        'splitHash'=>$newSplit->localHash
//                    ]);


    }

    public function splitDetails(Request $request,$splitName,$splitHash)
    {

        $splitDetails = NonRegisterUsers::where('localHash',$splitHash)->first();
        return view('splitDetails',[
            'splitDetails'=>$splitDetails
        ]);

    }

    public function addExpense(Request $request)
    {
        $expense = new Expenses;

        $expense->expenseType = request('data.expenseType');
        $expense->non_register_users_id = request('data.id');
        $expense->payerName = request('data.payer');
        $expense->amount = intval(request('data.amount'));
        $expense->forWhat = request('data.forWhat');
        $expense->createdAt = request('data.when');
        $expense->contributers = request('data.contributers');
        $expense->save();

        return $expense;
    }
    public function viewAllExpense(Request $request,$localHash)
    {
        $split = NonRegisterUsers::where('localHash',$localHash)->first();
        $allContributors = explode(",",$split->all_contributers);
        $expenses = $split->expenses;
        return view('viewExpenses',[
            'expenses'=>$expenses,
            'splitname'=>$split->split_name,
            'hash'=>$localHash,
            'allcontributors'=>$allContributors,
        ]);
    }






}
