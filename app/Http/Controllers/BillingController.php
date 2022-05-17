<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class BillingController extends Controller
{
 

    public function index(Request $request)
    {
        
      return view('Billing.index');
    }





}




