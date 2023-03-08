<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas;
use App\Models\Pengaduan;

class Tanggapan extends Model
{
    use HasFactory;
    protected $table = 'tanggapans';
    protected $fillable = ['pengaduan_id', 'tgl_tanggapan', 'tanggapan', 'petugas_id'];

    public function petugas()
    {
       return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }

    public function pengaduan()
    {
       return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id');
    }
}
