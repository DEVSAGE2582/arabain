<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Cache;
use Carbon;
use Validator;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request by checking username and password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function login(Request $request)
    // {
    //     // Validate the request data
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required|string|min:3|max:255',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Validation failed',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     // Attempt to authenticate the user
    //     if (Auth::attempt($request->only('username', 'password'))) {
    //         $user = Auth::user();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Login successful',
    //             'user' => $user
    //         ], 200);
    //     }

    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Invalid credentials'
    //     ], 401);
    // }

    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('username', $request->username)->first();
        if($user && $user->active=='inactive'){
            // dd('sds');
            return view('errors.active_over');

        }elseif(!$user){
            return redirect()->back()
            ->withErrors(['username' => 'Invalid credentials'])
            ->withInput();
        }

        // dd($user);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('username', 'password'), $request->has('remember'))) {
            // DD('WSD');
            $user = Auth::user();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'user' => $user
                ], 200);
            }

            $request->session()->regenerate();
            return redirect()->intended('/Dashboard');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        
        
    }



    /**
     * Log the user out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}