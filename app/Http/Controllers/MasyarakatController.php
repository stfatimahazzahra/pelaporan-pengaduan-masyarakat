<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masyarakats = Masyarakat::latest()->paginate(10);
        // return dd($masyarakat);
        return view('role.masyarakat.index', compact('masyarakats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('masyarakat.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request);
        // $validateData = $request->validate([
        //     'nik' => 'required',
        //     'nama' => 'required',
        //     'usernama' => 'required',
        //     'password' => 'required',
        //     'telp' => 'required'
        // ]);
        // $validateData['password'] = bcrypt($validateData['password']);

        // Masyarakat::create($validateData);

        // return redirect()->route('masyarakat.index')
        //                 ->with('success', 'Berhasil Menyimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function show(Masyarakat $masyarakat)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function edit(Masyarakat $masyarakat)
    {
        // return view('masyarakat.edit', compact('masyarakat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masyarakat $masyarakat)
    {
        // $request->validate([
        //     'nik' => 'required',
        //     'nama' => 'required',
        //     'usernama' => 'required',
        //     'password' => 'required',
        //     'telp' => 'required'
        // ]);

        // Masyarakat::update($request->all());

        // return redirect()->route('masyarakat.index')
        //                 ->with('success', 'Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::guard('petugas')->user()->level=="petugas") {
            return back()->with('error', 'Tidak bisa menghapus');
        }

        $masyarakat = Masyarakat::findOrFail($id);
        if ($masyarakat) {
            $masyarakat->delete();

            return redirect()->route('role.masyarakat.index')
                        ->with('success', 'Berhasil Dihapus!');
        }

        return redirect()->route('role.masyarakat.index')
                        ->with('error', 'Gagal Dihapus!');
    }
}