<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    /**
     * Get all by user id
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll() {
        $accounts = auth()->user()->accounts;
        return response()->json($accounts, 200);
    }

     /**
     * Get by account id
     *
     * @return \Illuminate\Http\Response
     */

    public function getById($id) {
        $result=Account::find($id);
        return response()->json($result, 200);
    }

    /**
     * Save data
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $req) {
        $req->validate(['name' => 'required']);    

        $account=new Account();
        $user_id=auth()->user()->id;
        $name=$req['name'];
        $result=$account->Register($user_id,$name);
        return response()->json($result, 200);
    }
}