<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginMasyarakat() {
        return view('auth.login');
    }

    public function loginMasyarakat(Request $request) {
        $validateData = $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        if(Auth::guard('masyarakat')->attempt(['username'=>$request->username, 'password'=>$request->password], $request->get('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('pengaduan.index');
        }

        return back()->with('loginError', 'Login gagal! Silahkan coba lagi');
    }

    public function showLoginPetugas() {
        return view('role.auth.login');
    }

    public function loginPetugas(Request $request) {
        $validateData = $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        if(Auth::guard('petugas')->attempt(['username'=>$request->username, 'password'=>$request->password], $request->get('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('pengaduan.indexPetugas');
        }

        return back()->with('loginError', 'Login gagal! Silahkan coba lagi');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();
        Auth::guard('petugas')->logout();

        return redirect()->route('login')->with('success', 'Anda Logout');
    }
}
