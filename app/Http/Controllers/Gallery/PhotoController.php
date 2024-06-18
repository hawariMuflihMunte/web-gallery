<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $foto = $request->validate([
            "judulfoto" => "required|min:1",
            "deskripsifoto" => "required|min:1",
        ]);

        $imageMessage = [
            "images.max" => "Ukuran maksimal file adalah 2MB !",
        ];

        $request->validate(
            [
                "image" => "required|image|mimes:jpg,jpeg,png|max:2048",
            ],
            $imageMessage
        );

        $currentDate = date("Y-m-d");
        $currentUserID = auth()->id();
        $currentAlbumID = $request->input("albumid");
        $album = Album::where("AlbumID", $currentAlbumID)->get()->first();

        $filename = preg_replace(
            "/[^a-zA-Z0-9]/",
            "",
            strtolower($request->file("image")->getClientOriginalName())
        );
        $extension = $request->file("image")->getClientOriginalExtension();
        $filenameWithoutExtension = str_replace($extension, "", $filename);
        $filenameWithExtension = $filenameWithoutExtension . "." . $extension;
        $filterAlbum = preg_replace(
            "/[^a-zA-Z0-9]/",
            "",
            strtolower($album["NamaAlbum"])
        );
        $filepath = $request
            ->file("image")
            ->storeAs($filterAlbum, $filenameWithExtension, "public");

        Foto::create([
            "JudulFoto" => $foto["judulfoto"],
            "DeskripsiFoto" => $foto["deskripsifoto"],
            "TanggalUnggah" => $currentDate,
            "LokasiFile" => $filepath,
            "AlbumID" => $currentAlbumID,
            "UserID" => $currentUserID,
        ]);

        return redirect()
            ->route("gallery.edit", [
                "gallery" => $album,
            ])
            ->with("success-insert", "Berhasil menambahkan foto baru !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto): View
    {
        // $foto = Foto::find($id);
        $likefoto = $foto->likefoto()->get();
        $komentarfoto = $foto->komentarfoto()->get();
        $commentcount = count($komentarfoto);
        $likes = count($foto->likefoto()->get());
        $album = $foto->album()->get()->first();
        $user = $foto->user()->get()->first();

        $currentUserID = auth()->id();
        $currentFotoOwnerID = $foto->user()->get()->first()["UserID"];
        $editable = false;
        $liked = false;

        if ($currentUserID == $currentFotoOwnerID) {
            $editable = true;
        }

        $likefotoArray = $likefoto->toArray();
        foreach ($likefotoArray as $like) {
            if (in_array($currentUserID, $like)) {
                $liked = true;
                $likefoto = $like;
                break;
            }
        }

        return view(
            "app.foto.details",
            compact(
                "foto",
                "likefoto",
                "album",
                "user",
                "editable",
                "liked",
                "likes",
                "commentcount",
                "komentarfoto"
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto): RedirectResponse
    {
        // $foto = Foto::find($id);
        $album = $foto->album()->get()->first();
        $splitStr = explode("/", $foto["LokasiFile"]);
        $path = join("\\", $splitStr);

        if (!Storage::disk("public")->has($path)) {
            return redirect()
                ->route("gallery.edit", $album)
                ->with(
                    "warning-destroy",
                    "Berkas tidak ditemukan. Berhasil menghapus foto !"
                );
        }

        Storage::disk("public")->delete($path);
        // Foto::destroy($id);
        $foto->delete();

        return redirect()
            ->route("gallery.edit", $album)
            ->with("success-destroy", "Berhasil menghapus foto !");
    }
}
