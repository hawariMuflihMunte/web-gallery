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
        Schema::create('album', function (Blueprint $table) {
            $table->id('AlbumID');
            $table->string('NamaAlbum', length: 255);
            $table->text('Deskripsi');
            $table->date('TanggalDibuat');
            $table->unsignedBigInteger('UserID');

            $table->foreign('UserID')->references('UserID')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album');
    }
};
