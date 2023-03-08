<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::all();
        
        return view('role.petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::guard('petugas')->user()->level == "petugas") {
            return back()->with('error', 'Tidak bisa mengubah data petugas, anda bukan admin!');
        }
        
        return view('role.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_petugas' => 'required',
            'username' => 'required|unique:petugas',
            'password' => 'required',
            'telp' => 'required',
            'level' => 'required',
        ]);
        $validateData['password'] = bcrypt($validateData['password']);

        Petugas::create($validateData);

        return redirect()->route('role.petugas.index')->with('success', 'Berhasil menambahkan data petugas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::guard('petugas')->user()->level == "petugas") {
            return back()->with('error', 'Tidak bisa mengubah data petugas, anda bukan admin');
        }

        $petugas = Petugas::find($id);

        return view('role.petugas.edit', compact('petugas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama_petugas' => 'required',
            'password' => 'required',
            'telp' => 'required',
            'level' => 'required',
        ]);
        $validateData['password'] = bcrypt($validateData['password']);

        $petugas = Petugas::findOrFail($id);
        $petugas->update($validateData);

        return redirect()->route('role.petugas.index')->with('success', 'Data petugas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::guard('petugas')->user()->level == "petugas") {
            return back()->with('error', 'Tidak bisa mengubah data petugas, anda bukan admin');
        }

        $petugas = Petugas::findOrFail($id);

        if ($petugas) {
            $petugas->delete();

            return redirect()->route('role.petugas.index')
                        ->with('success', 'Berhasil menghapus data petugas!');
        }

        return redirect()->route('role.petugas.index')
                        ->with('error', 'Gagal menghapus data petugas!');
    }
}
