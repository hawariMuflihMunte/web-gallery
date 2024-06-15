<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Database\Seeder;

class FotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = Album::all();

        foreach ($albums as $album) {
            Foto::create([
                "AlbumID" => $album->AlbumID,
                "UserID" => $album->UserID,
                "JudulFoto" => "Example",
                "DeskripsiFoto" => "Example Description",
                "TanggalUnggah" => now(),
                "LokasiFile" => "images/example.png",
            ]);
        }
    }
}
