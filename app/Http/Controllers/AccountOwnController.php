<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountOwn;
use Illuminate\Support\Facades\DB;

class AccountOwnController extends Controller
{
  /** Obtenemos el listado de cuentas que posee un usuario */
  public function me(Request $request)
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
    ], 200);
  }

  /** Obtenemos el listado de cuentas que posee un usuario */
  public function get(Request $request)
  {
    $account = AccountOwn::select(DB::raw("UPPER(CONCAT(tp_banks.name,'(', tp_account.name,') - N°', account_own.n_account,'- Saldo:', FORMAT(account_own.balance, 2, 'de_DE') ) ) AS n_account"), 'account_own.id', 'account_own.balance')
      ->join('tp_account', 'tp_account.id',  '=', 'account_own.id_tp_account')
      ->join('tp_banks', 'tp_banks.id',  '=', 'account_own.id_tp_banks')
      ->where('account_own.status', true)
      ->where('id_user', auth()->id())
      ->get();
    return response()->json([
      "account" => $account
    ], 200);
  }



  /** Obtenemos el listado de cuentas de los otros usuario */
  public function other(Request $request)
  {
    $account = AccountOwn::select(DB::raw("UPPER(CONCAT(users.name, ' - ', tp_banks.name,'(', tp_account.name,') - N°', account_own.n_account ) ) AS n_account"), 'account_own.id', 'account_own.balance')
      ->join('users', 'users.id',  '=', 'account_own.id_user')
      ->join('tp_account', 'tp_account.id',  '=', 'account_own.id_tp_account')
      ->join('tp_banks', 'tp_banks.id',  '=', 'account_own.id_tp_banks')
      ->where('account_own.status', true)
      ->where('id_user', '!=', auth()->id())
      ->get();
    return response()->json([
      "account" => $account
    ], 200);
  }
}
