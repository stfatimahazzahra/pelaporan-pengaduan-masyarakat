@extends('layouts.petugasMain')
@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card mt-3" style="width: 50rem;">
            <div class="mx-3 my-3">
                <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_petugas" class="form-label">Nama Petugas</label>
                        <input type="text" name="nama_petugas" class="form-control" id="nama_petugas">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">No Telepon</label>
                        <input type="text" name="telp" class="form-control" id="telp">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="level" aria-label="Default select example">
                            <option selected>Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a type="button" class="btn btn-outline-secondary"
                            href="{{ route('role.petugas.index') }}">Back</a>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
