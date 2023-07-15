<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelajaran_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('hari');
            $table->string('pengawas');
            $table->string('tanggal');
            $table->string('mulai');
            $table->string('selesai');
            $table->timestamps();
            $table->foreign('pelajaran_id')->references('id')->on('pelajarans')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujians');
    }
};