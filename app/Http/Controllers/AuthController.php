<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Session;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function form()
    {
        if(Auth::check()) return redirect()->route('/');
        
        // echo Hash::make('polman407');
        return view('login');
    }
    
    public function process(Request $request)
    {
        $data = [
            'user_npk'=> $request->user_npk,
            'password'  => $request->user_password
        ];

        print_r($data);

        if(!Auth::attempt($data))
        {
            //Login Fail
            Session::flash('error', 'Invalid NPK or password');
            return redirect()->route('login')->withInput($request->all);
        }

        Session::flash('success', 'Welcome, '.Auth::user()->user_npk.'!');
        if(Auth::check()) return redirect()->route('main');
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Logout berhasil, sampai jumpa!');
        return redirect()->route('login');
    }
}
