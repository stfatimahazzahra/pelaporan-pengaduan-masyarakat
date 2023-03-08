@extends('layouts.PetugasMain')
@section('content')

<div class="container">
    <div class="my-3">
    <h3>Data Masyarakat</h3>
    </div>
    <table class="table">
        <thead class="bg-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">No. Telpon</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($masyarakats as $masyarakat)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $masyarakat->nik }}</td>
            <td>{{ $masyarakat->nama }}</td>
            <td>{{ $masyarakat->username }}</td>
            <td>{{ $masyarakat->telp}}</td>
            <td>
                    <form action="{{ route('masyarakat.destroy', ['id'=>$masyarakat->id]) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
        </tr>
        @endforeach
    
    </tbody>
    </table>

    {{ $masyarakats->links() }}
</div>

@endsection
