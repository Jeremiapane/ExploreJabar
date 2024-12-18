<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique()->nullable();
            $table->string('foto_sampul');
            $table->longText('detail');
            $table->foreignId('kategori_id')->constrained('kategori_artikels')->onDelete('cascade');
            $table->enum('status', ['draf', 'aktif'])->default('draf');
            $table->foreignId('penulis_id')->constrained('pegawais')->onDelete('cascade');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
