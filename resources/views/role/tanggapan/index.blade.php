@extends('layouts.petugasMain')
@section('content')

<div class="container">

    <div class="my-4 me-3">
        <h3>Tanggapan</h3>
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
                <th scope="col">Nama Petugas</th>
                <th scope="col">Tanggal Tanggapan</th>
                <th scope="col">Tanggapan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tanggapans as $tanggapan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tanggapan->getNamaPetugas->nama_petugas }}</td>
                <td>{{ $tanggapan->tgl_tanggapan }}</td>
                <td>{{ $tanggapan->tanggapan }}</td>
                <td>{{ $tanggapan->getDetailPengaduan->status }}</td>
                <td>
                    <form action="{{ route('tanggapan.destroy', ['id_tanggapan'=>$tanggapan->id]) }}" method="POST">

                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $loop->index }}">
                            Detail
                        </button>

                        <a class="btn btn-sm btn-primary"
                            href="{{ route('tanggapan.edit', ['id_tanggapan'=>$tanggapan->id]) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                aria-labelledby="exampleModalLabel{{ $loop->index }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $loop->index }}">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <img src="{{ asset($tanggapan->getDetailPengaduan->foto) }}" alt="" class="w-50">
                                <div class="mb-3">
                                    <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                                    <input type="text" class="form-control" id="tgl_pengaduan"
                                        placeholder="{{ $tanggapan->getDetailPengaduan->tgl_pengaduan }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK Masyarakat</label>
                                    <input type="text" class="form-control" id="nik"
                                        placeholder="{{ $tanggapan->getDetailPengaduan->nik }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggapan" class="form-label">Isi Laporan</label>
                                    <input type="text" class="form-control" id="tanggapan"
                                        placeholder="{{ $tanggapan->getDetailPengaduan->isi_laporan }}" disabled>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    {{ $tanggapans->links() }}
</div>

@endsection
