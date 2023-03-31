<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function test_email(){
        $front_user = 'Redspark@mailinator.com';
        $message = "<h2>Hello Viral test</h2>
        <br>Password Reset Link <br>
        <a href='activation_link'> Reset Password </a>";
        $search = ['activation_link'];
        $content = 'welcome';
        Mail::send(
            ['html' => 'system_emails.email_html'],
            array(
                'content' => $content,
            ),
            function ($message) use ($front_user) {
                $message->from(env('MAIL_USERNAME'),'test');
                $message->to($front_user)->subject("Password Reset");
            }
        );
        dd('success');
    }
}
