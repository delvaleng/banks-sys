<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TpBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tp_banks')->insert([
      'id' => '1',
      'name'   => 'BANK OF AMERICAN',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_banks')->insert([
        'id' => '2',
        'name'   => 'BANCOLOMBIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_banks')->insert([
        'id' => '3',
        'name'   => 'CITYBANK',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
