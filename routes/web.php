<?php

use Illuminate\Support\Facades\Route;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(["prefix" => "google"], function () {
//     Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('redirect-google');
//     Route::get('/callback', 'Auth\LoginController@handleProviderCallback')->name('callback-google');
// });
Route::group(['prefix' => '2fa'], function () {
    Route::get('/', 'LoginSecurityController@show2faForm')->name('2fa');
    Route::post('/generateSecret', 'LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa', 'LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa', 'LoginSecurityController@disable2fa')->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});

// test middleware
Route::get('/test_middleware', function () {
    return "2FA middleware work!";
})->middleware(['auth', '2fa']);
Route::group([
    'middleware' => ['auth', 'verification']
], function () {

    Route::get('/quick-search', function () {
        return view('layout.partials.extras._quick_search_result');
    })->name('quick-search');

    // dashboard
    Route::group([
        'prefix' => 'dashboard',
        'as' => 'dashboard.',
        'middleware' => ['2fa']
    ], function () {
        Route::get('/', 'DashboardController@index');
    });

    // profile
    Route::group([
        'middleware' => ['2fa'],
        'prefix' => 'my-profile',
        'as' => 'profile.',
    ], function () {
        Route::get('/', 'UserController@userProfileView')->name('myProfile');
        Route::post('/', 'UserController@postUserProfile')->name('myProfilePost');

        Route::get('change-password', 'UserController@userPasswordView')->name('myPassword');
        Route::post('change-password', 'UserController@postUserPassword')->name('myPasswordPost');
    });

    //admin role


    Route::group([
        'middleware' => ['admin']
    ], function () {
        Route::resource('users', 'UserManagementController');
    });

    Route::resource('media-category', 'MediaCategoryController');
    Route::resource('media-file', 'MediaController');
    Route::post('media-file/upload', 'MediaController@upload')->name('media-file/upload');

    Route::resource('contacts', 'ContactController');
    Route::resource('contact-form', 'ContactFormController');

    Route::get('contact-form/{id}/reply', 'ContactFormController@reply')->name('contact-form.reply');
    Route::post('contact-form/{id}/reply', 'ContactFormController@postReply')->name('contact-form.reply.post');

    // Module Blog
    Route::group([
        'prefix' => 'blog',
        'as' => 'blog.',
    ], function () {
        Route::group([
            'prefix' => 'posts',
            'as' => 'posts.',
        ], function () {
            Route::get('/', 'PostController@list')->name('list');
            Route::get('data', 'PostController@data')->name('data');
            Route::get('{id}', 'PostController@detail')->name('detail');
            Route::post('create', 'PostController@create')->name('create');
            Route::post('update/{id}', 'PostController@update')->name('update');
            Route::get('delete/{id}', 'PostController@delete')->name('delete');
            Route::post('autosave', 'PostController@autosave')->name('autosave');
        });

        Route::group([
            'prefix' => 'pages',
            'as' => 'pages.',
        ], function () {
            Route::get('/', 'PageController@list')->name('list');
            Route::get('data', 'PageController@data')->name('data');
            Route::get('{id}', 'PageController@detail')->name('detail');
            Route::post('create', 'PageController@create')->name('create');
            Route::post('update/{id}', 'PageController@update')->name('update');
            Route::get('delete/{id}', 'PageController@delete')->name('delete');
        });

        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.',
        ], function () {
            Route::get('/', 'CategoryController@list')->name('list');
            Route::get('data', 'CategoryController@data')->name('data');
            Route::get('{id}', 'CategoryController@detail')->name('detail');
            Route::post('create', 'CategoryController@create')->name('create');
            Route::post('update/{id}', 'CategoryController@update')->name('update');
            Route::get('delete/{id}', 'CategoryController@delete')->name('delete');
        });

        Route::group([
            'prefix' => 'tags',
            'as' => 'tags.',
        ], function () {
            Route::get('/', 'TagController@list')->name('list');
            Route::get('data', 'TagController@data')->name('data');
            Route::get('{id}', 'TagController@detail')->name('detail');
            Route::post('create', 'TagController@create')->name('create');
            Route::post('update/{id}', 'TagController@update')->name('update');
            Route::get('delete/{id}', 'TagController@delete')->name('delete');
        });
    });

    // Module FAQ
    Route::group([
        'prefix' => 'faq',
        'as' => 'faq.',
    ], function () {
        Route::get('/', 'FAQController@list')->name('list');
        Route::get('data', 'FAQController@data')->name('data');
        Route::get('{id}', 'FAQController@detail')->name('detail');
        Route::post('create', 'FAQController@create')->name('create');
        Route::post('update/{id}', 'FAQController@update')->name('update');
        Route::get('delete/{id}', 'FAQController@delete')->name('delete');
    });

    // Scripts Management
    Route::group([
        'prefix' => 'scripts',
        'as' => 'scripts.',
    ], function () {
        Route::get('/', 'ScriptController@list')->name('list');
        Route::get('data', 'ScriptController@data')->name('data');
        Route::get('{id}', 'ScriptController@detail')->name('detail');
        Route::post('create', 'ScriptController@create')->name('create');
        Route::post('update/{id}', 'ScriptController@update')->name('update');
        Route::get('delete/{id}', 'ScriptController@delete')->name('delete');
    });

    // Settings
    Route::group([
        'prefix' => 'settings',
        'as' => 'settings.',
    ], function () {
        Route::get('/', 'SettingController@detail')->name('detail');
        Route::post('update', 'SettingController@update')->name('update');
    });

    // Activity Logs
    Route::group([
        'prefix' => 'activity-log',
        'as' => 'activity-log.',
    ], function () {
        Route::get('/', 'ActivityLogController@list')->name('list');
        Route::get('/data', 'ActivityLogController@data')->name('data');
        Route::get('/delete', 'ActivityLogController@delete')->name('delete');
        Route::post('/delete-selected', 'ActivityLogController@deleteSelectedIds')->name('delete-selected');
        Route::get('/delete-all', 'ActivityLogController@deleteAll')->name('delete-all');
    });
    // Log viewer
    Route::group([
        'prefix' => 'log-viewer',
        'as' => 'log-viewer.'
    ], function () {
        Route::get('/', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('list');
    });

    // Module google analytics
    Route::group([
        'prefix' => 'google-analytics',
        'as' => 'google-analytics.',
    ], function () {
        Route::get('callback', 'GoogleAnalyticsController@callback');
        Route::group([
            'prefix' => 'accounts',
            'as' => 'accounts.'
        ], function () {
            Route::get('/', 'GoogleAnalyticsController@index');
            Route::get('add', 'GoogleAnalyticsController@add');
            Route::get('detail/{id}', 'GoogleAnalyticsController@detail');
            Route::get('delete/{id}', 'GoogleAnalyticsController@delete');
            Route::post('select-website', 'GoogleAnalyticsController@selectWebsite')->name('select-website');
            //Chart
            // Route::post('vistor-by-date', 'GoogleAnalyticsController@getVisitorByDate')->name('get-visitor-by-date');
        });
        // Route::get('/', function () {
        // return view('google-analytics.list');
        // })->name('list');
    });



    // Module facebook
    Route::group([
        'prefix' => 'facebook-fanpage',
        'as' => 'facebook-fanpage.',
    ], function () {
        Route::get('/list', 'FacebookController@fanpageList')->name('list');
        Route::get('/remove/{id}', 'FacebookController@removeFacebookPage')->name('remove-fanpage');
        Route::get('/get-access-token/{accessToken}&{userID}', 'FacebookController@getAccessToken');
    });

    Route::group([
        'prefix' => 'facebook-ads',
        'as' => 'facebook-ads.'
    ], function () {
        Route::post('select-page', 'FacebookAdsAccountController@selectPage')->name('select-page');
        Route::get('/get-access-token/{accessToken}&{userID}', 'FacebookAdsAccountController@getAccessToken');
        Route::get('/get-access-tokenV2/{accessToken}&{userID}', 'FacebookAdsAccountController@getAccessTokenV2')->name('FBFlowToken');
        Route::get('/accounts', 'FacebookAdsAccountController@index');
        Route::group([
            'prefix' => 'accounts/{id}'
        ], function () {
            Route::get('insights', 'FacebookAdsAccountController@getInsights')->name('get-insights');
            Route::get('/delete', 'FacebookAdsAccountController@adsaccountdel')->name('get-insights');
            Route::group([
                'prefix' => 'campaigns'
            ], function () {
                Route::get('/', 'FacebookAdsCampaignController@listCampaigns')->name('listCampaigns');
                Route::get('/get-data', 'FacebookAdsCampaignController@getDataCampaigns')->name('getDataCampaigns');
            });
        });
        Route::group([
            'prefix' => 'campaigns/{id}'
        ], function () {
            Route::get('/delete', 'FacebookAdsCampaignController@deleteCampaign');
        });
    });
});



Route::group([
    'middleware' => ['auth', '2fa'], /// addded to implement 2fa on the user routes also
    'as' => 'authenticate.'
], function () {
    Route::post('/', 'UserController@postLogin');
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::post('agency-payment', 'StripeController@agencyPayment')->name('agency-payment');
    Route::post('plan-purchase-paymentt', 'StripeController@planPayment')->name('plan-payment');
    Route::get('/agency-spy', 'DashboardController@agency')->name('agency-spy');
    Route::get('/billing', 'BillingController@index')->name('billing');
    Route::post('/load_more', 'DashboardController@load_data')->name('load_more');
    Route::get('/connect-data', 'DashboardController@connect_data')->name('connect-data');


    Route::post('/onboarding', 'UserController@postOnboarding')->name('onboarding');
    Route::post('/has_agency', 'UserController@postHasAgency')->name('agency');
});

Route::get('/updatefacebookdata', 'CronController@cronToken')->name('updatefacebookdata');
Route::get('/login', 'UserController@loginView')->name('authenticate.login');
Route::post('/login', 'UserController@postLogin')->name('authenticate.loginPost');
Route::get('/register', 'UserController@registerView');
Route::post('/register', 'UserController@postRegister')->name('authenticate.register');

Route::get('/logout', 'UserController@postLogout')->name('authenticate.logout');

Route::get('/forgot-password', 'UserController@forgotPasswordView')->name('authenticate.forgot');
Route::post('/forgot-password', 'UserController@postforgotPassword')->name('authenticate.forgotPost');

Route::get('/reset-password/{email}/{token}', 'UserController@resetPasswordView')->name('authenticate.reset');
Route::post('/reset-password/{email}/{token}', 'UserController@postResetPassword')->name('authenticate.resetPost');

Route::get('/verify/{email}/{token}', 'UserController@verify')->name('authenticate.verify');

Route::get('/retype-email', 'UserController@retypeEmailView')->name('authenticate.retype-email');
Route::post('/retype-email', 'UserController@retypeEmail');
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/home', function(){
    return view('fakeDashboard.index');
});
Route::post('/application', function(){
    return view('fakeDashboard.result');
})->name('fakeDashboardResults');

Route::get('/application2', function(){
    return view('fakeDashboard.result2');
});

Route::get('/redirect', 'FBAuthController@redirect');
Route::get('/fblogin', 'FBAuthController@callback');

Route::post('/fbregister', 'FBAuthController@register');
Route::post('/fbregisterPage', 'FBAuthController@fbregisterPage');






Route::get('send-test-mail', function () {
    $sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
    dd($sendgrid);
    \App\Helpers\MailHelper::sendMail('ajyshrma69@gmail.com', 'd-d0980c7330eb4110ab7b302a4589cb73');
});
