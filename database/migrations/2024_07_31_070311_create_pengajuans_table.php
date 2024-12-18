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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('judul',100);
            $table->text('deskripsi');
            $table->string('dokumen');
            $table->foreignId('pemohon_id')->constrained('pegawais');
            $table->foreignId('approver1_id')->constrained('pegawais');
            $table->foreignId('approver2_id')->nullable()->constrained('pegawais');
            $table->enum('status', ['pending', 'ditolak', 'disetujui', 'disetujui oleh approver 1', 'pending approver 1', 'pending approver 2'])->default('pending');
            $table->text('catatan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
