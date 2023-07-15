<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUjian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Semester(){
        return $this->belongsTo(Semester::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
}