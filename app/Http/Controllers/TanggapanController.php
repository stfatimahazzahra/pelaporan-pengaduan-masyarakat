<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggapans = Tanggapan::latest()->with('getNamaPetugas', 'getDetailPengaduan')->paginate(5);
        
        return view('role.tanggapan.index', compact('tanggapans'));
    }

    public function indexLaporan()
    {
        $laporans = Tanggapan::latest()->with('getNamaPetugas', 'getDetailPengaduan')->paginate(10);
        
        return view('role.indexLaporan', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_pengaduan)
    {
        $pengaduan = Pengaduan::find($id_pengaduan);

        return view('role.tanggapan.create', compact('pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_pengaduan)
    {
        $validateData = $request->validate([
            'tgl_tanggapan' => 'required',
            'tanggapan' => 'required',
            // 'id_pengaduan' => 'required',
            // 'id_petugas' => 'required',
        ]);

        $updateStatus = Pengaduan::findOrFail($id_pengaduan);
        $updateStatus->status = $request->status;
        $updateStatus->update();

        Tanggapan::create([
            'tgl_tanggapan' => $validateData['tgl_tanggapan'],
            'tanggapan' => $validateData['tanggapan'],
            'pengaduan_id' => $id_pengaduan,
            'petugas_id' => Auth::guard('petugas')->user()->id
        ]);

        return redirect()->route('pengaduan.indexPetugas')
                        ->with('success', 'Berhasil menyimpan tanggapan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function show(Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function edit($id_tanggapan)
    {
        $tanggapan = Tanggapan::find($id_tanggapan);
        $pengaduan = Pengaduan::find($tanggapan->id_pengaduan);
        return view('role.tanggapan.edit', compact('pengaduan', 'tanggapan'));
    }

    public function update(Request $request, $id_tanggapan)
    {
        $request->validate([
            'id_pengaduan' => 'required',
            'tgl_tanggapan' => 'required',
            'tanggapan' => 'required',
            'id_petugas' => 'required',
        ]);

        $updateStatus = Pengaduan::findOrFail($request->id_pengaduan);
        $updateStatus->status = $request->status;
        $updateStatus->update();

        $data = Tanggapan::findOrFail($id_tanggapan);
        $data->tgl_tanggapan = $request->tgl_tanggapan;
        $data->tanggapan = $request->tanggapan;
        $data->id_petugas = $request->id_petugas;
        $data->update();

        return redirect()->route('role.tanggapan.index')->with('success', 'Berhasil mengubah tanggapan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tanggapan)
    {
        $tanggapan = Tanggapan::findOrFail($id_tanggapan);
        if ($tanggapan) {
            $tanggapan->delete();

            return redirect()->route('role.tanggapan.index')
                        ->with('success', 'Tanggapan berhasil dihapus!');
        }

        return redirect()->route('role.tanggapan.index')
                        ->with('error', 'Tanggapan gagal dihapus!');
    }

    public function generatePDF() 
    {
        $admin = Auth::guard('petugas')->user()->nama;
        $tanggapans = Tanggapan::latest()->with('getNamaPetugas', 'getDetailPengaduan')->get();

        $data = [
            'judul' => "Generate Tanggapann dan Pengaduan",
            'admin' => $admin,
            'tanggapans' => $tanggapans,
        ];

        $pdf = Pdf::loadView('role.generate', $data)->setPaper('a4');

        return $pdf->stream();
    }
}
