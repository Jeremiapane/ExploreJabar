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
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->string('judul',100);
            $table->text('deskripsi');
            $table->foreignId('pemohon_id')
                  ->nullable()
                  ->constrained('users') // Menghubungkan ke tabel `users`
                  ->onDelete('set null');
            $table->date('tanggal_kejadian'); // Menyimpan tanggal kejadian
            $table->enum('status', ['Diajukan', 'Diverifikasi', 'Diselesaikan', 'Ditolak'])
                  ->default('Diajukan');
            $table->string('bukti_path');
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->foreignId('verifikator_id')
                  ->nullable()
                  ->constrained('pegawais') // Menghubungkan ke tabel `pegawais`
                  ->onDelete('set null');
            $table->timestamp('tanggal_penyelesaian')->nullable();
            $table->foreignId('penyelesai_id')
                  ->nullable()
                  ->constrained('pegawais') // Menghubungkan ke tabel `pegawais`
                  ->onDelete('set null');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Menambahkan indeks pada kolom foreign key
            $table->index(['pemohon_id', 'verifikator_id', 'penyelesai_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduans');
    }
};
