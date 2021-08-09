<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
      'id' => '1',
      'identy' => '0021255894',
      'name'   => 'Gloribel Delgado',
      'email'  => 'delgadogloribelv@gmail.com',
      'password' => Hash::make('1234'),
      'status' => true,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('users')->insert([
      'id' => '2',
      'identy' => '0123456789',
      'name'   => 'Katherine Valenzuela',
      'email'  => 'katherine@yopmail.com',
      'password' => Hash::make('1234'),
      'status' => true,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('users')->insert([
      'id' => '3',
      'identy' => '9876543210',
      'name'   => 'Andres Delgado',
      'email'  => 'andres@yopmail.com',
      'password' => Hash::make('1234'),
      'status' => false,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

    }
}
