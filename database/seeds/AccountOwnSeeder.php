<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AccountOwnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('account_own')->insert([
        'id' => 1,
        'id_user' => 1,
        'id_tp_account' => 1,
        'id_tp_banks'   => 1,
        'n_account' => rand(100000,999999),
        'balance' => 20000000,
        'status' => true,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('account_own')->insert([
        'id' => 2,
        'id_user' => 1,
        'id_tp_account' => 2,
        'id_tp_banks'   => 1,
        'n_account' => rand(100000,999999),
        'balance' => 8520000,
        'status' => true,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('account_own')->insert([
        'id' => 3,
        'id_user' => 1,
        'id_tp_account' => 3,
        'id_tp_banks'   => 1,
        'n_account' => rand(100000,999999),
        'balance' => 0,
        'status' => false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);


      DB::table('account_own')->insert([
        'id' => 4,
        'id_user' => 2,
        'id_tp_account' => 1,
        'id_tp_banks'   => 1,
        'n_account' => rand(100000,999999),
        'balance' => 960255,
        'status' => true,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('account_own')->insert([
        'id' => 5,
        'id_user' => 2,
        'id_tp_account' => 2,
        'id_tp_banks'   => 2,
        'n_account' => rand(100000,999999),
        'balance' => 0,
        'status' => false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('account_own')->insert([
        'id' => 6,
        'id_user' => 2,
        'id_tp_account' => 3,
        'id_tp_banks'   => 2,
        'n_account' => rand(100000,999999),
        'balance' => 0,
        'status' => false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);



      DB::table('account_own')->insert([
        'id' => 7,
        'id_user' => 3,
        'id_tp_account' => 3,
        'id_tp_banks'   => 1,
        'n_account' => rand(100000,999999),
        'balance' => 30000,
        'status' => true,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('account_own')->insert([
        'id' => 8,
        'id_user' => 3,
        'id_tp_account' => 2,
        'id_tp_banks'   => 2,
        'n_account' => rand(100000,999999),
        'balance' => 0,
        'status' => false,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);


    }
}
