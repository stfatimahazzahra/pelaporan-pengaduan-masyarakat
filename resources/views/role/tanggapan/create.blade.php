@extends('layouts.petugasMain')
@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card mt-3" style="width: 50rem;">
            <div class="mx-3 my-3">
                <form action="{{ route('tanggapan.store', ['id_pengaduan'=>$pengaduan->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tgl_tanggapan" class="form-label">Tanggal Tanggapan</label>
                        <input type="date" name="tgl_tanggapan" class="form-control" id="tgl_tanggapan">
                    </div>
                    <div class="mb-3">
                        <label for="tanggapan" class="form-label">Tanggapan</label>
                        <textarea name="tanggapan" class="form-control" id="tanggapan"
                            style="height: 100px;"></textarea>
                        <input type="hidden" name="id_petugas" value="{{ Auth::guard('petugas')->user()->id }}">
                        <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id }}">
                    </div>
                    <div class="mb-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status :</strong>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1"
                                            value="proses" checked>
                                        <label class="form-check-label" for="status1">
                                            Proses
                                        </label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input class="form-check-input" type="radio" name="status" id="status2"
                                            value="selesai">
                                        <label class="form-check-label" for="status2">
                                            Selesai
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a type="button" class="btn btn-outline-secondary"
                            href="{{ route('pengaduan.indexPetugas') }}">Back</a>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
