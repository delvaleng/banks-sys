<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountOwn;

class AccountOwnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->ajax()){
          return AccountOwn::where('id_user', auth()->id())->get();
      }else{
          return view('home');
      }
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
