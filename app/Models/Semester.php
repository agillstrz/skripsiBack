<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $guarded =  ['id'];

    public function nilai(){
        return $this->hasMany(Nilai::class);
    }
    public function nilaiUjian(){
        return $this->hasMany(NilaiUjian::class);
    }
    public function pembayaran(){
        return $this->hasMany(Pembayaran::class);
    }
    public function kelas(){
        return $this->hasMany(Kelas::class);
    }
}