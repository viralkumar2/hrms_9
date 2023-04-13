<?php

namespace App;

use App\helpers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Result;
use App\Helpers\Helper;
use App\Models\Service;
use App\Models\FrontUser;
use App\Models\OrderItem;
use App\Models\Membership;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Email extends Authenticatable
{
    public static function employee_email($id){
        $employee = Employee::find($id);
        $content = "<h2>Hello Viral test</h2>";
        Mail::send(
            ['html' => 'system_emails.employee_email_birthday'],
            array(
                'content' => $content,
                'user'    => $employee

            ),
            function ($message) use ($employee) {
                $message->from(env('MAIL_USERNAME'),'Employee Birthday');
                $message->to($employee->email)->subject("Employee Birthday");
            }
        );
        session()->flash('success', 'An Email has been send to your registered email address. Kindly reset your password.');

    }

    public static function employee_anniversary_send_email($id){
        $employee = Employee::find($id);

        $content = "<h2>Hello Viral test</h2>";
        Mail::send(
            ['html' => 'system_emails.employee_email_anniversary'],
            array(
                'content' => $content,
                'user'    => $employee

            ),
            function ($message) use ($employee) {
                $message->from(env('MAIL_USERNAME'),'Employee Anniversary');
                $message->to($employee->email)->subject("Employee Anniversary");
            }
        );
        session()->flash('success', 'An Email has been send to your registered email address. Kindly reset your password.');

    }
}
