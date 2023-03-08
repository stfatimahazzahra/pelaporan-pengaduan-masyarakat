<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Controller;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masyarakat_id = Auth::guard('masyarakat')->user()->id;
        // return $masyarakat_id;

        $masyarakat = Masyarakat::find($masyarakat_id);
        // return $masyarakat;

        // $pengaduans = $masyarakat->pengaduan()->get();
        $pengaduans = Pengaduan::where('masyarakat_id', $masyarakat_id)->with('tanggapan')->get();
        // return $pengaduans;

        // $pengaduans = Pengaduan::all();
        // return $pengaduans;

        return view('pengaduan.index', compact('pengaduans'));
    }

    public function indexPetugas()
    {
        $pengaduans = Pengaduan::latest()->with('tanggapan')->paginate(5);

        return view('pengaduan.indexPetugas', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengaduan.create');
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
            'tgl_pengaduan' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'required|image|mimes:jpg,svg,png',
            'nik' => 'required',
            'masyarakat_id' => 'required'
        ]);
        $fileImage = hexdec(uniqid()) . "." . $request->foto->extension();
            Image::make($request->file('foto'))->save('assets/images/' . $fileImage);
            $pengaduanImage = 'assets/images/' . $fileImage;

            $validateData['foto'] = $pengaduanImage;
            $validateData['status'] = "0";


            Pengaduan::create($validateData);

        return redirect()->route('pengaduan.index')
                        ->with('success', 'Berhasil menyimpan pengaduan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        
        return view('pengaduan.edit' , compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tgl_pengaduan' => 'required',
            'nik' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'image|mimes:jpg,svg,png',
        ]);
        if ($request->file('foto')) {
            $fileImage = hexdec(uniqid()) . "." . $request->foto->extension();
            Image::make($request->file('foto'))->save('assets/images/' . $fileImage);
            $pengaduanImage = 'assets/images/' . $fileImage;

            $data = Pengaduan::findOrFail($id);
            $data->tgl_pengaduan = $request->tgl_pengaduan;
            $data->isi_laporan = $request->isi_laporan;
            $data->foto = $pengaduanImage;
            $data->update();
        } else {
            $data = Pengaduan::findOrFail($id);
            $data->tgl_pengaduan = $request->tgl_pengaduan;
            $data->isi_laporan = $request->isi_laporan;
            $data->foto = $request->foto_lama;
            $data->update();
        }
        return redirect()->route('pengaduan.index')->with('success', 'Berhasil mengubah pengaduan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
                        ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
