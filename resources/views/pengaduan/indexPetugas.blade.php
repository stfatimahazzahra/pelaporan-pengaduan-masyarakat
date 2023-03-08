@extends('layouts.PetugasMain')
@section('content')

<div class="container">

    <div class="my-4 me-3">
        <h3>Pengaduan Masyarakat</h3>
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
                <th scope="col">Tanggal Pengaduan</th>
                <th scope="col">NIK</th>
                <th scope="col">Isi Laporan</th>
                <th scope="col">Foto</th>
                <th scope="col">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduans as $pengaduan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengaduan->tgl_pengaduan }}</td>
                <td>{{ $pengaduan->nik }}</td>
                <td>{{ $pengaduan->isi_laporan }}</td>
                <td><img src="{{ asset($pengaduan->foto) }}" alt="" width="100px"></td>
                <td>{{ $pengaduan->status }}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $loop->index }}">
                        Detail
                    </button>
                    <a class="btn btn-sm btn-primary"
                        href="{{ route('tanggapan.create', $pengaduan->id) }}">Tanggapi</a>
                </td>
            </tr>

            <!-- Modal -->
            
            @endforeach
        </tbody>
    </table>

    {{ $pengaduans->links() }}
</div>

@endsection
