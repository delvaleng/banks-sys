<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TpAccount;

class TpAccountController extends Controller
{
    /** Obtenemos el listado de tipos de cuenta */
    public function index(Request $request)
    {
        $tpaccount = TpAccount::get();
        return response()->json([
            "tpaccount" => $tpaccount
        ], 200);
    }
}
