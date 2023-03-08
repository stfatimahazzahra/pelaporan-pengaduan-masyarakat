<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegisterMasyarakat() {
        return view('auth.register');
    }

    public function registerMasyarakat(Request $request) {
        $validateData = $request->validate([
            'nik' => 'required|unique:masyarakats',
            'nama' => 'required',
            'username' => 'required|unique:masyarakats',
            'password' => 'required',
            'telp' => 'required',
        ]);
        $validateData['password'] = bcrypt($validateData['password']);

        Masyarakat::create($validateData);

        return redirect('login')->with('success', 'Registrasi Berhasil!');
    }
}
