<?php

namespace App\Helpers;

use SendGrid\Mail\Mail;

class MailHelper
{
    public static function sendMail($email, $template_id)
    {
        $email = new Mail();
        $email->setFrom(env('MAIL_FROM_ADDRESS'), "Ash Yazey");
        $email->setSubject("I'm replacing the subject tag");
        $email->addTo(
            "test+test1@example.com",
            "Example User1",
            [
                "subject" => "Subject 1",
                "name" => "Example User 1",
                "city" => "Denver"
            ],
            0
        );
        $email->addTo(
            "test+test2@example.com",
            "Example User2",
            [
                "subject" => "Subject 2",
                "name" => "Example User 2",
                "city" => "Denver"
            ],
            1
        );
        $email->addTo(
            "test+test3@example.com",
            "Example User3",
            [
                "subject" => "Subject 3",
                "name" => "Example User 3",
                "city" => "Redwood City"
            ],
            2
        );
        $email->setTemplateId($template_id);
        $sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ' .  $e->getMessage() . "\n";
        }
    }
}
