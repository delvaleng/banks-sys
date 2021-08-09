<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountOwn;
use Illuminate\Support\Facades\DB;

class AccountOwnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $account = AccountOwn::select(DB::raw("UPPER(CONCAT(tp_banks.name,'(', tp_account.name,') - N°', account_own.n_account,'- Saldo:', FORMAT(account_own.balance, 2, 'de_DE') ) ) AS n_account"), 'account_own.id', 'account_own.balance')
        ->join('tp_account', 'tp_account.id',  '=', 'account_own.id_tp_account')
        ->join('tp_banks', 'tp_banks.id',  '=', 'account_own.id_tp_banks')
        ->where('account_own.status', true)
        ->where('id_user', auth()->id())
        ->get();
        return response()->json([
           "account" => $account
        ],200);
    }


    public function myAccount(Request $request)
    {
        $account = AccountOwn::select([
          'account_own.id',
          'account_own.id_user',
          'account_own.id_tp_account',
          'tp_account.name as tp_account',
          'account_own.id_tp_banks',
          'tp_banks.name as tp_banks',
          'account_own.n_account',
          'account_own.balance',
          'account_own.status',
        ])
        ->join('tp_account', 'tp_account.id',  '=', 'account_own.id_tp_account')
        ->join('tp_banks', 'tp_banks.id',  '=', 'account_own.id_tp_banks')
        ->where('id_user', auth()->id())
        ->get();
        return response()->json([
           "account" => $account
        ],200);
    }

    public function list(Request $request)
    {
      $account = AccountOwn::select(DB::raw("UPPER(CONCAT(users.name, ' - ', tp_banks.name,'(', tp_account.name,') - N°', account_own.n_account ) ) AS n_account"), 'account_own.id', 'account_own.balance')
        ->join('users', 'users.id',  '=', 'account_own.id_user')
        ->join('tp_account', 'tp_account.id',  '=', 'account_own.id_tp_account')
        ->join('tp_banks', 'tp_banks.id',  '=', 'account_own.id_tp_banks')
        ->where('account_own.status', true)
        ->where('id_user','!=', auth()->id())
        ->get();
        return response()->json([
           "account" => $account
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $accountOwn = new AccountOwn();
      $accountOwn->id_user = auth()->id();
      $accountOwn->id_tp_account = $request->id_tp_account;
      $accountOwn->n_account = rand(100000,999999);
      $accountOwn->balance = $request->balance;
      $accountOwn->save();

      return $accountOwn;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $accountOwn = AccountOwn::find($id);
      $accountOwn->id_user = auth()->id();
      $accountOwn->id_tp_account = $request->id_tp_account;
      $accountOwn->n_account = $request->n_account;
      $accountOwn->balance = $request->balance;
      return $accountOwn;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
