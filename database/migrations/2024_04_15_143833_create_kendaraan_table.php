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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('merk');
            $table->string('no_plat');
            $table->string('tahun_pembuatan');
            $table->string('warna');
            $table->integer('kapasitas_minimum');
            $table->integer('kapasitas_maximum');
            $table->text('fitur');
            $table->string('status_verifikasi');
            $table->string('status_kendaraan');
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('agen_travel')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
