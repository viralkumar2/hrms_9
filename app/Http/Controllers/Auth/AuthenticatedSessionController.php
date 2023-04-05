<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Utility;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function __construct()
    {
        if(!file_exists(storage_path() . "/installed"))
        {
            header('location:install');
            die;
        }
    }

    /*protected function authenticated(Request $request, $user)
    {
        if($user->delete_status == 1)
        {
            auth()->logout();
        }

        return redirect('/check');
    }*/

    public function store(LoginRequest $request)
    {

        if(env('RECAPTCHA_MODULE') == 'yes')
        {
            $validation['g-recaptcha-response'] = 'required|captcha';
        }else{
            $validation=[];
        }
        $this->validate($request, $validation);

        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();


        if($user->is_active == 0)
        {
            auth()->logout();
            return redirect()->route('login');
        }

        $user =\Auth::user();
        // dd($user);
        if($user->type == 'company')
        {
            $plan = plan::find($user->plan);
            if($plan)
            {
                if($plan->duration != 'unlimited')
                {
                    $datetime1 = $user->plan_expire_date;
                    $datetime2 = date('Y-m-d');

                    // dd($datetime1,$datetime2);

                    if(!empty($datetime1) && $datetime1 < $datetime2)
                    {
                        $user->assignplan(1);

                        return redirect()->intended(RouteServiceProvider::HOME)->with('error',__('Yore plan is expired'));
                    }
                }
            }
        }

        if($user->type == 'company')
        {
            $free_plan = Plan::where('price', '=', '0.0')->first();
            $plan      = Plan::find($user->plan);

            if($user->plan != $free_plan->id)
            {
                if(date('Y-m-d') > $user->plan_expire_date && $plan->duration != 'Unlimited')
                {
                    $user->plan             = $free_plan->id;
                    $user->plan_expire_date = null;
                    $user->save();

                    $users     = User::where('created_by', '=', \Auth::user()->creatorId())->get();
                    $employees = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();

                    if($free_plan->max_users == -1)
                    {
                        foreach($users as $user)
                        {
                            $user->is_active = 1;
                            $user->save();
                        }
                    }
                    else
                    {
                        $userCount = 0;
                        foreach($users as $user)
                        {
                            $userCount++;
                            if($userCount <= $free_plan->max_users)
                            {
                                $user->is_active = 1;
                                $user->save();
                            }
                            else
                            {
                                $user->is_active = 0;
                                $user->save();
                            }
                        }

                    }


                    if($free_plan->max_employees == -1)
                    {
                        foreach($employees as $employee)
                        {
                            $employee->is_active = 1;
                            $employee->save();
                        }
                    }
                    else
                    {
                        $employeeCount = 0;
                        foreach($employees as $employee)
                        {
                            $employeeCount++;
                            if($employeeCount <= $free_plan->max_customers)
                            {
                                $employee->is_active = 1;
                                $employee->save();
                            }
                            else
                            {
                                $employee->is_active = 0;
                                $employee->save();
                            }
                        }
                    }

                    return redirect()->route('home')->with('error', 'Your plan expired limit is over, please upgrade your plan');
                }
            }

        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function showLoginForm($lang = '')
    {
        if($lang == '')
        {
            $lang = \App\Models\Utility::getValByName('default_language');
        }
        \App::setLocale($lang);

        return view('auth.login', compact('lang'));
    }

    public function showLinkRequestForm($lang = '')
    {
        if($lang == '')
        {
            $lang = \App\Models\Utility::getValByName('default_language');
        }

        \App::setLocale($lang);

        return view('auth.forgot-password', compact('lang'));
    }
    public function storeLinkRequestForm(Request $request)
    {

        if(env('RECAPTCHA_MODULE') == 'yes')
        {
            $validation['g-recaptcha-response'] = 'required|captcha';
        }else{
            $validation=[];
        }
        $this->validate($request, $validation);

        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        try{

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                                ->withErrors(['email' => __($status)]);
        }
        catch(\Exception $e)
        {

            return redirect()->back()->withErrors('E-Mail has been not sent due to SMTP configuration');

        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
