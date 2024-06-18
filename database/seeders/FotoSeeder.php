<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foto')->delete();

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
