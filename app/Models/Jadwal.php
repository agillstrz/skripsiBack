<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $guarded=['id'];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class );
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
}