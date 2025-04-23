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
        Schema::create('surat_balasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->string('file');
            $table->date('tanggal_upload');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_balasans');
    }
};
