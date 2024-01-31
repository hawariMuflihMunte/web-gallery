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
        Schema::create('foto', function (Blueprint $table) {
            $table->id('FotoID');
            $table->string('JudulFoto', length: 255);
            $table->text('DeskripsiFoto');
            $table->date('TanggalUnggah');
            $table->string('LokasiFile', length: 255);
            $table->unsignedBigInteger('AlbumID');
            $table->unsignedBigInteger('UserID');

            $table->foreign('AlbumID')->references('AlbumID')->on('album')->onDelete('cascade');
            $table->foreign('UserID')->references('UserID')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto');
    }
};
