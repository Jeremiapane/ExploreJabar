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
        Schema::create('agen_travel', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_perusahaan')->nullable();
            $table->string('no_telp_perusahaan')->nullable();
            $table->text('alamat_perusahaan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status_verifikasi', ['diproses', 'aktif', 'ditolak', 'pending'])->default('diproses')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('id_parent_operasional')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('verifikator_id')->nullable();
            $table->foreign('verifikator_id')->references('id')->on('pegawais')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agen_travel');
    }
};
