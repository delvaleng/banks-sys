<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OauthClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('oauth_clients')->insert([
      'id' => '1',
      'name'   => 'Sistema de transacciones bancarias en línea Personal Access Client',
      'secret' => '0FywnZ0EE9xW6GzOWL3DJvgFGWd9MTAiXP0sYTnW',
      'provider'=> null,
      'redirect'=> 'http://localhost',
      'personal_access_client'=>1,
      'password_client'=>0,
      'revoked'=>0,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('oauth_clients')->insert([
        'id' => '2',
        'name'   => 'Sistema de transacciones bancarias en línea Password Grant Client',
        'secret' => '9cSCSkNHNGgkETalEa4BWcE3rjdsFpFbj12yJMAc',
        'provider'=> null,
        'redirect'=> 'http://localhost',
        'personal_access_client'=>1,
        'password_client'=>1,
        'revoked'=>0,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
      ]);

    }
}
