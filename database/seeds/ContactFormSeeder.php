<?php

use Illuminate\Database\Seeder;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contact_forms')->insert([
            'contact_id' => 1,
            'subject' => 'Hỗ trợ về dịch Covid',
            'content' => '<p>Cần hỗ trợ về thời gian dịch Covid</p><p>Cần mua sắm các dụng cụ y tế</p>',
            'is_reply' => 1,
        ]);
        DB::table('contact_forms')->insert([
            'contact_id' => 1,
            'subject' => 'Hỗ trợ về dịch Covid lần 1',
            'content' => '<p>Cần hỗ trợ về thời gian dịch Covid</p><p>Cần mua sắm các dụng cụ y tế lần 2</p>',
            'is_reply' => 0,
        ]);
    }
}
