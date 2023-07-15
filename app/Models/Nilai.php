<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $guarded=['id'];


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

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

}