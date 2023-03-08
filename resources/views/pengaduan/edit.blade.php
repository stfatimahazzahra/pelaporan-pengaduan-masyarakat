@extends('layouts.main')
@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card mt-3" style="width: 50rem;">
            <div class="mx-3 my-3">
                <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                        <input type="date" name="tgl_pengaduan" class="form-control" id="tgl_pengaduan" value="{{ $pengaduan->tgl_pengaduan }}">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" value="{{ $pengaduan->nik }}">
                    </div> -->
                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea name="isi_laporan" class="form-control" id="isi_laporan" style="height: 100px;">{{ $pengaduan->isi_laporan }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto">
                        <input type="hidden" name="foto_lama" class="form-control" value="{{ $pengaduan->foto }}">
                        <input type="hidden" name="nik" value="{{ Auth::guard('masyarakat')->user()->nik }}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a type="button" class="btn btn-outline-secondary"
                            href="{{ route('pengaduan.index') }}">Back</a>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
