<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function semester(){
        return $this->belongsTo(Semester::class);
    }
 
    
}