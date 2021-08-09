<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(OauthClientsSeeder::class);
      $this->call(TpAccountSeeder::class);
      $this->call(TpBankSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(AccountOwnSeeder::class);


    }
}
