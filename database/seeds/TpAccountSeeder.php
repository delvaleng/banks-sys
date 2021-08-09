<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TpAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tp_account')->insert([
      'id' => '1',
      'name'   => 'AHORRO',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_account')->insert([
        'id' => '2',
        'name'   => 'CORRIENTE',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_account')->insert([
        'id' => '3',
        'name'   => 'VIRTUAL',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
