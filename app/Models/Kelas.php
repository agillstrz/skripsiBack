<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function siswa(){
        return $this->hasMany(Siswa::class);
    }
    public function guru(){
        return $this->belongsTo(Kelas::class, 'id_guru','id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
    public function jadwalUjian()
    {
        return $this->hasMany(JadwalUjian::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
    public function nilaiUjian()
    {
        return $this->hasMany(NilaiUjian::class);
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function semester()
    {
        return $this->hasMany(Semester::class);
    }


 
}