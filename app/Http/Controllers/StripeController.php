<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class StripeController extends Controller
{
    //

    public function agencyPayment(Request $request)
    {
        $output['status'] = 500;
        $output['message'] = 'Error while capturing Payment';
        if ($request->token) {
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            try {
                $response =   $stripe->charges->create([
                    'amount' => 2900,
                    'currency' => 'usd',
                    'source' => $request->token,
                    'description' => 'Payment from ' . auth()->user()->email . ' for connect with agency',
                ]);

                if ($response->status == 'succeeded') {
                    $output['status'] = 200;
                    $output['message'] = 'Payment Successfull';
                }
            } catch (\Exception $e) {
                $output['status'] = 500;
                $output['message'] = 'Error while capturing Payment. ' . $e->getMessage();
            }
        }

        return response()->json($output);
    }

    public function planPayment(Request $request)
    {
        $output['status'] = 500;
        $output['message'] = 'Error while capturing Payment';
        if ($request->token && $request->amount > 0) {

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            try {
                $response =   $stripe->charges->create([
                    'amount' => $request->amount * 100,
                    'currency' => 'usd',
                    'source' => $request->token,
                    'description' => 'Payment from ' . auth()->user()->email . ' for Plan Purhcase for amount ' . $request->amount,
                ]);

                if ($response->status == 'succeeded') {
                    $output['status'] = 200;
                    $output['message'] = 'Payment Successfull';
                }
            } catch (\Exception $e) {
                $output['status'] = 500;
                $output['message'] = 'Error while capturing Payment. ' . $e->getMessage();
            }
        }

        return response()->json($output);
    }
}
