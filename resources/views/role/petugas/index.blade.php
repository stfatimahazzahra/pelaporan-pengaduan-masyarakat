@extends('layouts.PetugasMain')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between my-4 me-3">
        <h3>Data Petugas</h3>
        <div class="button">
            <a type="button" class="btn btn-success" href="{{ route('petugas.create') }}">Create</a>
        </div>
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
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">No. Telpon</th>
                <th scope="col">Level</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petugas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_petugas }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->telp}}</td>
                <td>{{ $item->level}}</td>
                <td>
                    <form action="{{ route('petugas.destroy', ['id'=>$item->id]) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('petugas.edit', ['id'=>$item->id]) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    
</div>

@endsection
