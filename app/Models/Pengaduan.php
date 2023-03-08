<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tanggapan;
use App\Models\Masyarakat;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'pengaduans';
    protected $fillable = ['masyarakat_id', 'tgl_pengaduan', 'nik', 'isi_laporan', 'foto', 'status'];

    // public function getDetailTanggapan()
    // {
    //     return $this->belongsTo(Tanggapan::class, 'id', 'id_pengaduan');
    // }

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'masyarakat_id', 'id');
    }

    public function tanggapan() 
    {
        return $this->hasMany(Tanggapan::class, 'petugas_id');
    }
}