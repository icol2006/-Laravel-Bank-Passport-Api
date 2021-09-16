<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsMovementsController extends Controller
{

    /**
     * Shows the index page.
     *
     * @param  \App\Models\Account
     * @return \Illuminate\Http\Response
     */
    public function getAllByAccountId($account_id)
    {
        $movements = Movement::where('account_id',$account_id)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($movements, 200);
    }

    /**
     * Save the movement
     *
     * @param Request $req
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function save(Request $req, $account_id)
    {
        $req->validate(['amount' => 'required|numeric', 'description' => 'nullable']);   

        $account=Account::Find($account_id);
        $amount = $req['amount'];
        $description= $req['description'];

        $result=Movement::Register($account, $amount, $description);        
        return response()->json($result, 200);
    }
}
