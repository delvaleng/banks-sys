<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TranferOwn;
use App\Models\AccountOwn;
use Illuminate\Support\Facades\DB;


class TranferOwnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $tranferOwn->id_account_own_origen = $request->origen{'id'};
        $tranferOwn->id_account_own_destino = $request->destino{'id'};
        $tranferOwn->mount = $request->cost;
        $tranferOwn->n_transfer = rand(100000,999999);
        $tranferOwn->mount_prev = $mount_prev;
        $tranferOwn->mount_next = $origenResto;
        $tranferOwn->save();


          DB::commit();
          // all good
      } catch (\Exception $e) {
          DB::rollback();
          return response()->json([
             "error" => $e,
             "status"=> false,
             "msg"=> "Ha ocurrido un error en la operación",

          ],200);
      }

      return response()->json([
         "tranferOwn" => $tranferOwn,
         "status"=> true,
         "msg"=> "Operación exitosa - N° de Transacción: ".$tranferOwn->n_transfer,
      ],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
