@extends('layouts.main')
@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card mt-3" style="width: 50rem;">
            <div class="mx-3 my-3">
                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                        <input type="date" name="tgl_pengaduan" class="form-control" id="tgl_pengaduan">
                    </div>
                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea name="isi_laporan" class="form-control" id="isi_laporan" style="height: 100px;"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto">
                        <input type="hidden" name="nik" value="{{ Auth::guard('masyarakat')->user()->nik }}">
                        <input type="hidden" name="masyarakat_id" value="{{ Auth::guard('masyarakat')->user()->id }}">
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
