<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function authLogin(Request $request) {
        // dd($request->all());
        if(Auth::attempt($request->only('email', 'password'))) {
            if(auth()->user()->user_role == 'admin' || auth()->user()->user_role == 'manajemen') {
                
                return redirect('/dashboard');

            } elseif(auth()->user()->user_role == 'gudang') {

                return redirect('/produksi');

            } elseif(auth()->user()->user_role == 'kasir') {

                return redirect('/penjualan');

            } else {

                return redirect('/logout');

            }
        }
        else {
            return redirect('/login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
