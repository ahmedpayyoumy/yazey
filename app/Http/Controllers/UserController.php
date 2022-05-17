<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use App\Role;
use App\Industry;
use Illuminate\Support\Facades\Auth;
use Mail;
use Hash;
use App\Mail\ResetPassword;
use App\Mail\ResetPasswordInvalid;
use App\Mail\ResetPasswordSuccess;
use App\Mail\ConfirmEmail;
use App\Mail\WelcomeEmail;
use App\Helpers\FileHelper;
use App\Helpers\UserHelper;
use App\Helpers\CompanyHelper\CompanyHelper;
use Illuminate\Support\Facades\Validator;
use App\Services\Industry\IndustryService;

class UserController extends Controller
{
    private $industryService = null;

    public function __construct(
        IndustryService $industryService
    ) {
        $this->industryService = $industryService;
    }

    protected function validateRegisterCredentials($credentials)
    {
        return Validator::make($credentials, [
            'email' => ['required', 'regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i'],
            'password' => ['required','confirmed', 'regex:/^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})/'],
        ], [
            'email.required' => 'Email is required!',
            'email.regex' => 'Invalid email!',
            'password.required' => 'Password is required!',
            'password.regex' => 'Invalid password!',
            'password.confirmed' => 'Confirm Password does not match!',
        ]);
    }
    protected function validateLoginCredentials($credentials)
    {
        return Validator::make($credentials, [
            'email' => ['required', 'regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email is required!',
            'email.regex' => 'Invalid Email!',
            'password.required' => 'Password is required!',
        ]);
    }
    protected function validateForgotPasswordCredentials($credentials)
    {
        return Validator::make($credentials, [
            'email' => ['required', 'regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i'],
        ], [
            'email.required' => 'Email is required!',
            'email.regex' => 'Invalid Email!',
        ]);
    }
    protected function validateOnboarding($credentials)
    {
        return Validator::make($credentials, [
            'industry_id' => ['required'],
            'has_agency' => ['required'],
            'agency_info' => ['required_if:has_agency,1'],
        ], [
            'industry_id.required' => 'Industry is required!',
            'has_agency.required' => 'Agency Select is required!',
            'agency_info.required_if' => 'Agency Info is required',
        ]);
    }
    public function postRegister(Request $request)
    {
        // dd($request->all());
        $validated = $this->validateRegisterCredentials($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->errors()->first());
            return redirect()->back();
        }
        $validated = $validated->validate();
        $userEmail = User::where('email', $validated['email'])->first();
        if ($userEmail) {
            toastr()->error('Email has been used!');
            return view('authenticate.register')->with([
                'danger_email' => 'Email has been used!'
            ]);
        }
        $check = User::where('email', $validated['email'])->first();
        if ($check) {
            toastr()->error('Email has been used!!');
            return redirect()->back();
        }

        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['email'],
            'is_active' =>'1',
            'password' => bcrypt($validated['password']),
            'permission'=>'dashboard_roas,dashboard_sales,dashboard_traffic,dashboard_past_year_sales,agency_spy,roas_performenance,industry_average,roas_ranking_table,rank_no,monthly_traffic,monthly_sale,marketing_spend,marketing_roas'
        ]);


        if (!$user) {
            toastr()->error('Email does not exist or token expired');
            return view('authenticate.retype-email')->with('danger', 'Email chưa đăng ký tài khoản Telusales!');
        }
        Mail::to($user->email)->send(new ConfirmEmail($user));
        if (count(Mail::failures()) > 0) {
            toastr()->error('An error occurred sending mail, please try again later!');
            return view('authenticate.retype-email')->with('danger', 'An error occurred sending mail, please try again later!');
        } else {
            return view('authenticate.verify')->with('email', $user->email);
        }

        // return view('authenticate.onboarding')->with([
        //     'user' => $user,
        //     'industries' => $this->industryService->list()
        // ]);
    }
    public function loginView()
    {
        return view('authenticate.login');
    }
    public function registerView()
    {
        return view('authenticate.register');
    }
    public function postLogin(Request $request)
    {
        $user = Auth::loginUsingId(User::where('email',$request->email)->first()->id);
        /*$validated = $this->validateLoginCredentials($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect(route('authenticate.login'))->withInput();
        }
        $validated = $validated->validate();
        $userData = array(
            'email'     => $validated['email'],
            'password'  => $validated['password'],
        );
        $user = Auth::attempt($userData);

        if (!$user) {
            toastr()->error('Invalid login infomation!');
            return redirect(route('authenticate.login'))->withInput();
        }
        $user_login = Auth::user();
        if ($user_login->is_active=='0') {
            toastr()->error('Please contact to support for activate your account');
            Auth::logout();
            return redirect(route('authenticate.login'))->withInput();
        }
        $user = Auth::user();
        if (is_null($user->industry_id) || is_null($user->has_agency) || ($user->has_agency == User::HAS_AGENCY && !$user->agency_info)) {
            return view('authenticate.onboarding')->with([
                'user' => $user,
                'industries' => $this->industryService->list()
            ]);
        }*/
        return redirect('/dashboard');
    }
    public function postLogout(Request $request)
    {
        Auth::logout();
        return redirect(route('authenticate.login'));
    }
    public function forgotPasswordView()
    {
        return view('authenticate.forgot-password');
    }
    public function postForgotPassword(Request $request)
    {
        $validated = $this->validateForgotPasswordCredentials($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect(route('authenticate.forgot'))->with('danger', $validated->messages()->first());
        }
        $user = User::where([
            'email' => $request->email,
            'is_verify' => 1
        ])->first();
        if (!$user) {
            Mail::to($request->email)->send(new ResetPasswordInvalid($request->email));
            if (count(Mail::failures()) > 0) {
                toastr()->error('An error occurred sending mail, please try again later!');
                return redirect(route('authenticate.forgot'))->with('danger', 'An error occurred sending mail, please try again later!');
            } else {
                toastr()->error('Email does not exist');
                return redirect(route('authenticate.forgot'))->with('danger', 'Email chưa đăng ký tài khoản Telusales!');
            }
        }
        Mail::to($user->email)->send(new ResetPassword($user));
        if (count(Mail::failures()) > 0) {
            toastr()->error('An error occurred sending mail, please try again later!');
            return redirect(route('authenticate.forgot'))->with('danger', 'An error occurred sending mail, please try again later!');
        } else {
            return view('authenticate.forgot-password-confirm')->with('email', $user->email);
        }
    }
    public function resetPasswordView($email, $token)
    {
        $user = User::where([
            'email' => $email,
            'token' => $token,
        ])->first();
        if (!$user) {
            toastr()->error('Email does not exist or token expired');
            return view('authenticate.reset-password')->with('danger', 'Email does not exist or token expired');
        }
        return view('authenticate.reset-password');
    }
    public function postResetPassword(Request $request)
    {
        $user = User::where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
        if (!$user) {
            toastr()->error('Email does not exist or token expired');
            return view('authenticate.reset-password')->with('danger', 'Email does not exist or token expired');
        }
        $user->password = bcrypt($request->password);
        $user->token = null;
        $user->save();
        Mail::to($user->email)->send(new ResetPasswordSuccess($user->email));
        if (count(Mail::failures()) > 0) {
            toastr()->error('An error occurred sending mail, please try again later!');
            return redirect(route('authenticate.reset'))->with('danger', 'An error occurred sending mail, please try again later!');
        } else {
            toastr()->success('Change password successfully! you can login again!');
            return redirect(route('authenticate.login'));
        }
    }
    public function verify($email, $token)
    {
        $user = User::where([
            'email' => $email,
            'token' => $token
        ])->first();

        if (!$user) {
            toastr()->error('Email does not exist or token expired');
            return view('authenticate.reset-password')->with('danger', 'Email does not exist or token expired');
        }

        $user->token = null;
        $user->save();
        Mail::to($user->email)->send(new WelcomeEmail($user));
        if (count(Mail::failures()) > 0) {
            toastr()->error('An error occurred sending mail, please try again later!');
            return view('authenticate.verify')->with('danger', 'An error occurred sending mail, please try again later!');
        } else {
            $user->is_active = 1;
            $user->is_verify=1;
            $user->save();
            Auth::login($user, true);
            return redirect('/dashboard');
        }
    }

    public function retypeEmailView()
    {
        return view('authenticate.retype-email');
    }

    public function retypeEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            toastr()->error('Email does not exist or token expired');
            return view('authenticate.retype-email')->with('danger', 'Email chưa đăng ký tài khoản Telusales!');
        }
        Mail::to($user->email)->send(new ConfirmEmail($user));
        if (count(Mail::failures()) > 0) {
            toastr()->error('An error occurred sending mail, please try again later!');
            return view('authenticate.retype-email')->with('danger', 'An error occurred sending mail, please try again later!');
        } else {
            return view('authenticate.verify')->with('email', $user->email);
        }
    }

    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function updateUserInfoWelcome(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        return redirect('/dashboard');
    }

    public function userProfileView()
    {
        $user = Auth::user();
        if ($user) {
            return view('pages.profile.index');
        }
        return redirect(route('authenticate.login'));
    }
    public function postUserProfile(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->name)) {
                $user->name = $request->name;
            }
            if (isset($request->email)) {
                $user->email = $request->email;
            }
            if (isset($request->phone_number)) {
                $user->phone_number = $request->phone_number;
            }
            if (isset($request->profile_avatar)) {
                if ($user->avatar) {
                    FileHelper::delete($user->avatar);
                }
                $url = FileHelper::upload($request->profile_avatar);
                $user->avatar = $url;
            }
            $user->save();
            toastr()->success('User information update successful!');
            return redirect()->back()->with([
                'success' => 'User information update successful!'
            ]);
        }
    }

    public function userPasswordView()
    {
        $user = Auth::user();
        if ($user) {
            return view('pages.profile.password');
        }
        return redirect(route('authenticate.login'));
    }
    public function postUserPassword(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->current_password)) {
                if (!Hash::check($request->current_password, $user->password)) {
                    toastr()->error('Invalid Password.');
                    return redirect()->back()->with([
                        'danger' => 'Invalid Password.'
                    ]);
                }
                $user->password = bcrypt($request->new_password);

                if (isset($request->new_password) && isset($request->verify_password)) {
                    if ($request->new_password != $request->verify_password) {
                        toastr()->error('Confirm Password does not match');
                        return redirect()->back()->with([
                            'danger' => 'Confirm Password does not match'
                        ]);
                    }

                    if (isset($request->new_password)) {
                        $user->password = bcrypt($request->new_password);
                    }
                    $user->save();
                    toastr()->success('User information update successful!');
                    return redirect()->back()->with([
                        'success' => 'User information update successful!'
                    ]);
                }
                toastr()->error('Please enter a new password!');
                return redirect()->back()->with([
                    'danger' => 'Please enter a new password!'
                ]);
            }
            toastr()->error('Please enter a old password!');
            return redirect()->back()->with([
                'danger' => 'Please enter a old password!'
            ]);
        }
    }

    public function postOnboarding(Request $request)
    {


        $validated = $this->validateOnboarding($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->errors()->first());
            return redirect()->back();
        }

        $data = $request->all();

        // $user = User::where([
        //     'id' => $data['user_id'],
        //     'is_active' => false
        // ])->first();
       $user = User::where([
            'id' => $data['user_id']
        ])->first();
        if (!$user) {
            toastr()->error('User does not exist!');
            return redirect()->back();
        }

        $user->industry_id = $data['industry_id'];
        $user->agency_info = $data['agency_info'];
        $user->save();
        Auth::loginUsingId($user->id);

        return redirect('/dashboard');

        // Mail::to($user->email)->send(new ConfirmEmail($user));
        // if (count(Mail::failures()) > 0) {
        //     toastr()->error('An error occurred sending mail, please try again later!');
        //     return redirect(route('authenticate.register'))->with('danger', 'An error occurred sending mail, please try again later!');
        // } else {
        //     return view('authenticate.verify')->with('email', $user->email);
        // }
    }

    public function postHasAgency(Request $request){

        $data = $request->all();

        // $user = User::where([
        //     'id' => $data['user_id'],
        //     'is_active' => false
        // ])->whereNull('has_agency')->first();

      $user = User::where([
            'id' => $data['user_id']
        ])->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'User does not exist!'
            ], 404);
        }
        $user->has_agency = $data['has_agency'];
        $user->save();
        return response()->json([
            'error' => false,
            'user'  => $user,
        ], 200);
    }
}
