<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
            $finduser_by_email = User::where('email', $user->email)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/dashboard');
            } else if ($finduser_by_email) {
                Auth::login($finduser_by_email);

                return redirect('/dashboard');
            } else {

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'is_verify' => 1,
                    'is_active' => 1,
                    'password' => encrypt('123456dummy'),
                    'permission' => 'dashboard_roas,dashboard_sales,dashboard_traffic,dashboard_past_year_sales,agency_spy,roas_performenance,industry_average,roas_ranking_table,rank_no,monthly_traffic,monthly_sale,marketing_spend,marketing_roas'
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }
        } catch (Exception $e) {

            toastr()->error('Something went wrong please try again');
            return redirect(route('authenticate.login'))->withInput();
        }
    }
}
