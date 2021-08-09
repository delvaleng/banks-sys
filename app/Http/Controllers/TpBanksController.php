<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TpBanks;

class TpBanksController extends Controller
{
    /** Obtenemos el listado de tipos de bancos */
    public function index(Request $request)
    {
      $tpbanks = TpBanks::get();
      return response()->json([
         "tpbanks" => $tpbanks
      ],200);
    }
}
