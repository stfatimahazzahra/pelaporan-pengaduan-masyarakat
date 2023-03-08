<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Pengaduan Masyarakat</title>
</head>

<body>
    <span><strong>Nama Petugas:</strong>{{ Auth::guard('petugas')->user()->nama_petugas }}</span>
    <table class="table text-center" border="1">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Pengaduan</th>
                <th scope="col">Isi Laporan</th>
                <th scope="col">Tanggapan</th>
                <th scope="col">NIK Pelapor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tanggapans as $tanggapan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tanggapan->getDetailPengaduan->tgl_pengaduan }}</td>
                <td>{{ $tanggapan->getDetailPengaduan->isi_laporan }}</td>
                <td>{{ $tanggapan->tanggapan }}</td>
                <td>{{ $tanggapan->getDetailPengaduan->nik }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
