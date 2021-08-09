<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TranferOwn;
use App\Models\AccountOwn;
use Illuminate\Support\Facades\DB;


class TranferOwnController extends Controller
{
  /** Obtenemos el listado de transacciones que posee un usuario */
  public function index(Request $request)
  {
    $destino = AccountOwn::select('id')->where('id_user', auth()->id())->get();
    $ids = array();

    foreach ($destino as $key) {
      array_push($ids, $key->id);
    }


    $tranferOwn = TranferOwn::select([
      'transfer_own.id_user',
      'destino.id_user as id_user_destino',

      'id_account_own_origen',
      'origen.n_account as n_account_origen',

      'id_account_own_destino',
      'destino.n_account as n_account_destino',

      'mount',
      'mount_prev',
      'mount_next',
      'n_transfer',
    ]);

    $tranferOwn = $tranferOwn->join('account_own as origen',  'origen.id',  '=', 'transfer_own.id_account_own_origen');
    $tranferOwn = $tranferOwn->join('account_own as destino', 'destino.id',  '=', 'transfer_own.id_account_own_destino');
    $tranferOwn = $tranferOwn->where('transfer_own.id_user', auth()->id());
    // $tranferOwn = $tranferOwn->OrwhereIn('transfer_own.id_account_own_destino', $ids);

    if ($request->id_account_own_origen) {
      $tranferOwn = $tranferOwn->where('transfer_own.id_account_own_origen', $request->id_account_own_origen);
    }
    $tranferOwn = $tranferOwn->get();

    return response()->json([
      "tranferOwn" => $tranferOwn
    ], 200);
  }
  /** Creamos una transaccion */
  public function create(Request $request)
  {

    $origen = AccountOwn::find($request->origen{'id'});
    $destino = AccountOwn::find($request->destino{'id'});


    DB::beginTransaction();

    try {

      $mount_prev  = $origen->balance;
      $origenResto = $origen->balance - $request->cost;
      $destinoSumo = $destino->balance + $request->cost;

      $origen->balance = $origenResto;
      $origen->update();

      $destino->balance = $destinoSumo;
      $destino->update();

      $tranferOwn = new TranferOwn();
      $tranferOwn->id_user = auth()->id();
      $tranferOwn->id_account_own_origen = $request->origen{'id'};
      $tranferOwn->id_account_own_destino = $request->destino{'id'};
      $tranferOwn->mount = $request->cost;
      $tranferOwn->n_transfer = rand(100000, 999999);
      $tranferOwn->mount_prev = $mount_prev;
      $tranferOwn->mount_next = $origenResto;
      $tranferOwn->status = true;
      $tranferOwn->save();


      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json([
        "error" => $e,
        "status" => false,
        "msg" => "Ha ocurrido un error en la operación",

      ], 200);
    }

    return response()->json([
      "tranferOwn" => $tranferOwn,
      "status" => true,
      "msg" => "Operación exitosa - N° de Transacción: " . $tranferOwn->n_transfer,
    ], 200);
  }
}
