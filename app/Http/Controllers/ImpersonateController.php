<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Barcode;
use App\Models\User;
use DB;
use Carbon;
use Artisan;
use App\Utils\TransactionUtil;
use App\Utils\ProductUtil;
use Illuminate\Support\Str;
use Auth;
use Cache;

class ImpersonateController extends Controller
{


    public function impersonate(Request $request, $user_id){
        
        $user = User::findOrFail($user_id);  
        $administrator = Auth::user();
        Auth::logout();     
        Auth::guard('web')->loginUsingId($user->id); 

        $request->session()->regenerate();


        
        // Redirect to the desired location after impersonating
        return redirect()->route('home');
    }


    public function impersonate_voucher_company(Request $request, $user_id){
        // dd($user_id);

        $user = User::findOrFail($user_id);
        // dd($user);

        $administrator = Auth::user();
        
        // Log the administrator out
        Auth::logout();
        
        // Log in as the specified user
        Auth::login($user, true);
        
        // Redirect to the desired location after impersonating
        return redirect()->route('home');

    }
    
 


}




