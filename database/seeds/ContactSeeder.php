<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contacts')->insert([
            'email' => 'ngan.nguyen@eastplayers.io',
            'name' => 'ngan',
            'phone_number' => '0987654321',
            'address' => '123/3 duong so 42',
        ]);
    }
}
