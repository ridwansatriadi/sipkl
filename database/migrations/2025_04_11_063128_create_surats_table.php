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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuans');
            $table->enum('jenis_surat', ['Surat Permohonan Izin','Surat Jalan', 'Surat Penarikan']);
            $table->date('tanggal_terbit');
            $table->string('file_surat')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nomor_surat_izin')->nullable();
            $table->string('nomor_surat_jalan')->nullable();
            $table->string('nomor_surat_penarikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
