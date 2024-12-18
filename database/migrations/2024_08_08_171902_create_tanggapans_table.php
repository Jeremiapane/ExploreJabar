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
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id(); // ID otomatis
            $table->string('perihal'); // Kolom perihal
            $table->text('isi'); // Kolom isi
            $table->unsignedBigInteger('pengirim_id'); // Kolom pengirim_id
            $table->unsignedBigInteger('pemberitahuan_id'); // Kolom pemberitahuan_id
            $table->string('lampiran')->nullable(); // Kolom lampiran (nullable jika tidak wajib)
            $table->timestamps(); // Kolom created_at dan updated_at

            // Definisikan foreign key
            $table->foreign('pengirim_id')->references('id')->on('agen_travel')->onDelete('cascade');
            $table->foreign('pemberitahuan_id')->references('id')->on('pemberitahuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapans');
    }
};
