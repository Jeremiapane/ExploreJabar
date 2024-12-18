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
        Schema::create('pemandu_wisata', function (Blueprint $table) {
            $table->id();
            $table->string('keahlian');
            $table->text('sertifikasi');
            $table->text('deskripsi');
            $table->string('status_pemandu');
            $table->string('status_verifikasi');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_kategori_paket');
            $table->foreign('id_kategori_paket')->references('id')->on('kategori_paket')->onDelete('cascade');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('agen_travel')->onDelete('cascade');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemandu_wisata');
    }
};
