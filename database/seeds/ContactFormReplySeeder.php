<?php

use Illuminate\Database\Seeder;

class ContactFormReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contact_form_replies')->insert([
            'form_id' => 1,
            'user_id' => 1,
            'content' => '<p>Đồng ý với các yêu cầu mua sắm dịch vụ y tế</p><p>Yêu cầu mua sắm thêm các thiết bị khác</p>',
        ]);
    }
}
