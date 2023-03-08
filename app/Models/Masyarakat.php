<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

use App\Models\Pengaduan;

class Masyarakat extends Model
{
    use HasFactory;
    protected $table = 'masyarakats';
    protected $guard = 'masyarakat';
    protected $fillable = ['nik', 'nama', 'username', 'password', 'telp'];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'masyarakat_id');
    }
}
