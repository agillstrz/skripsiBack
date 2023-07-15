<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class );
    }
   
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
}