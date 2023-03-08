@extends('layouts.petugasMain')
@section('content')

<div class="container">

<div class="my-4 me-3">
    <div class="d-flex justify-content-between">
        <h3>Generate Laporan</h3>
        <a class="btn btn-success mb-3" href="{{ route('generate.pdf') }}">Laporan</a>
    </div>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <table class="table">
        <thead class="bg-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal pengaduan</th>
                <th scope="col">isi Laporan</th>
                <th scope="col">Tanggapan</th>
                <th scope="col">NIK Pelapor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $laporan->getDetailPengaduan->tgl_pengaduan }}</td>
                <td>{{ $laporan->getDetailPengaduan->isi_laporan }}</td>
                <td>{{ $laporan->tanggapan }}</td>
                <td>{{ $laporan->getDetailPengaduan->nik }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $laporans->links() }}
</div>

@endsection
