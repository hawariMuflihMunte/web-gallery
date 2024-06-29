<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FotoController extends Controller
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

        $request->validate(
            [
                "images" => "required|array",
                "images.*" => "required|mimes:jpg,jpeg,png|max:2048",
            ],
            [
                "images.max" => "Ukuran maksimal file adalah 2MB !",
            ]
        );

        $currentDate = date("Y-m-d");
        $currentUserID = auth()->id();
        $slug = $request->slug;
        $album = Album::firstWhere(["slug" => $slug]);
        $images = $request->file("images");

        $i = 0;
        foreach ($images as $image) {
            $sanitizedImage =
                strtotime($album["TanggalUnggah"]) .
                random_int(0, 999999) .
                "." .
                strtolower($image->getClientOriginalExtension());
            $filterAlbum = preg_replace(
                "/[^a-zA-Z0-9]/",
                "",
                strtolower($album["NamaAlbum"])
            );
            $filepath = $image->storeAs(
                $filterAlbum,
                $sanitizedImage,
                "public"
            );

            Foto::create([
                "JudulFoto" => $foto["judulfoto"][$i],
                "DeskripsiFoto" => $foto["deskripsifoto"][$i],
                "TanggalUnggah" => $currentDate,
                "LokasiFile" => $filepath,
                "AlbumID" => $album["AlbumID"],
                "UserID" => $currentUserID,
            ]);

            $i++;
        }

        return redirect()
            ->route("album.edit", $album["slug"])
            ->with([
                "upload-success" => __("app.images_upload_success"),
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto): View
    {
        $likefoto = $foto->likefoto()->get();
        $komentarfoto = $foto->komentarfoto()->get();
        $commentcount = count($komentarfoto);
        $likes = count($foto->likefoto()->get());
        $album = $foto->album()->first();
        $user = $foto->user()->first();

        $currentUserID = auth()->id();
        $currentFotoOwnerID = $foto->user()->first()->UserID;

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
            "pages.photo-show",
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
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
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
        $album = $foto->album()->first();
        $splitStr = explode("/", $foto["LokasiFile"]);
        $path = join("\\", $splitStr);

        if (!Storage::disk("public")->exists($path)) {
            return redirect()
                ->route("gallery.edit", $album)
                ->with([
                    "photo_file_not_found_delete_success" => __(
                        "app.photo_file_not_found_delete_success"
                    ),
                ]);
        }

        Storage::disk("public")->delete($path);

        $foto->delete();

        return redirect()
            ->route("album.edit", $album["slug"])
            ->with([
                "photo_delete_success" => __("app.photo_delete_success"),
            ]);
    }
}
