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
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->text('include');
            $table->text('exclude');
            $table->integer('jumlah_peserta');
            $table->string('status_verifikasi');
            $table->string('status_paket');
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('agen_travel')->onDelete('cascade');
            $table->unsignedBigInteger('id_objek_wisata');
            $table->foreign('id_objek_wisata')->references('id')->on('objek_wisatas')->onDelete('cascade');
            $table->unsignedBigInteger('id_pemandu_wisata');
            $table->foreign('id_pemandu_wisata')->references('id')->on('pemandu_wisata')->onDelete('cascade');
            $table->unsignedBigInteger('id_kendaraan');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraan')->onDelete('cascade');
            $table->unsignedBigInteger('id_kategori_paket');
            $table->foreign('id_kategori_paket')->references('id')->on('kategori_paket')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
