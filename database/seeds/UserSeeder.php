<?php

use Illuminate\Database\Seeder;

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
          'name' => 'EastPlayers',
          'email' => 'hello@eastplayers.io',
          'password' => bcrypt('123456789')
        ]);
        DB::table('users')->insert([
          'name' => 'ngan',
          'email' => 'ngan.nguyen@eastplayers.io',
          'password' => bcrypt('Eastplayers@0407')
        ]);
    }
}
