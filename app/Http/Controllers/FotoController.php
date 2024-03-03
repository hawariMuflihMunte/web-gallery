<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    $currentUserID = Auth::id();
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
    $filterAlbum = preg_replace("/[^a-zA-Z0-9]/", "", strtolower($album["NamaAlbum"]));
    $filepath = $request->file("image")->storeAs($filterAlbum, $filenameWithExtension, "public");

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
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id): View
  {
    $foto = Foto::find($id);
    $likefoto = $foto->likefoto()->get()->first();
    $album = $foto->album()->get()->first();
    $user = $foto->user()->get()->first();

    $currentUserID = Auth::id();
    $currentFotoOwnerID = $foto->user()->get()->first()["UserID"];
    $editable = false;
    $liked = false;

    if ($currentUserID == $currentFotoOwnerID) {
      $editable = true;
    }

    if (!empty($likefoto) && $likefoto["UserID"] == $currentUserID) {
      $liked = true;
    }

    return view("foto.details", compact("foto", "likefoto", "album", "user", "editable", "liked"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id): RedirectResponse
  {
    $foto = Foto::find($id);
    $album = $foto->album()->get()->first();
    $splitStr = explode("/", $foto["LokasiFile"]);
    $path = join("\\", $splitStr);

    if (!Storage::disk("public")->has($path)) {
      return redirect()
        ->route("gallery.edit", $album)
        ->with("warning-destroy", "Berkas tidak ditemukan. Berhasil menghapus foto !");
    }

    Storage::disk("public")->delete($path);
    Foto::destroy($id);

    return redirect()
      ->route("gallery.edit", $album)
      ->with("success-destroy", "Berhasil menghapus foto !");
  }
}
