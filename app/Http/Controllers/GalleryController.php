<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View|RedirectResponse
  {
    $albums = Album::all();
    $user = Auth::user();

    return view("home", compact("albums", "user"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view("gallery.add");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    $albumMessage = [
      "namaalbum.min" => "Masukkan minimal 1 karakter !",
      "deskripsi.min" => "Masukkan minimal 1 karakter !",
    ];

    $album = $request->validate(
      [
        "namaalbum" => "required|string|min:1",
        "deskripsi" => "required|string|min:1",
      ],
      $albumMessage
    );

    $foto = $request->validate([
      "judulfoto" => "required|min:1",
      "deskripsifoto" => "required|min:1",
    ]);

    $imagesMessage = [
      "images.max" => "Ukuran maksimal file adalah 2MB !",
    ];

    $request->validate(
      [
        "images" => "required",
        "images.*" => "required|image|mimes:jpg,jpeg,png|max:2048",
      ],
      $imagesMessage
    );

    $currentDate = date("Y-m-d");
    $currentUserID = Auth::id();

    $newAlbum = Album::create([
      "NamaAlbum" => $album["namaalbum"],
      "Deskripsi" => $album["deskripsi"],
      "TanggalDibuat" => $currentDate,
      "UserID" => $currentUserID,
    ]);

    $currentAlbumID = $newAlbum["AlbumID"];

    for ($i = 0; $i < count($request->file("images")); $i++) {
      $filename = preg_replace(
        "/[^a-zA-Z0-9]/",
        "",
        strtolower($request->file("images")[$i]->getClientOriginalName())
      );
      $extension = $request->file("images")[$i]->getClientOriginalExtension();
      $filenameWithoutExtension = str_replace($extension, "", $filename);
      $filenameWithExtension = $filenameWithoutExtension . "." . $extension;
      $filterAlbum = preg_replace("/[^a-zA-Z0-9]/", "", strtolower($album["namaalbum"]));
      $filepath = $request
        ->file("images")
        [$i]->storeAs($filterAlbum, $filenameWithExtension, "public");

      // dd($filename, $filenameWithoutExtension, $filenameWithExtension, $filepath);

      Foto::create([
        "JudulFoto" => $foto["judulfoto"][$i],
        "DeskripsiFoto" => $foto["deskripsifoto"][$i],
        "TanggalUnggah" => $currentDate,
        "LokasiFile" => $filepath,
        "AlbumID" => $currentAlbumID,
        "UserID" => $currentUserID,
      ]);
    }

    return redirect()
      ->route("gallery.index")
      ->with("insert-success", "Berhasil menambahkan album baru !");
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
    $album = Album::find($id);
    $foto = $album->foto()->get();

    /**
     * return current signed-in user to check
     * whether they own the album or not.
     */
    $currentUserID = Auth::id();
    $albumOwnerID = $album->user()->get()->first()["UserID"];
    $editable = true;

    if ($currentUserID != $albumOwnerID) {
      $editable = false;
    }

    return view("gallery.details", compact("album", "foto", "editable"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id): RedirectResponse
  {
    $album = Album::find($id);

    $newData = $request->validate([
      "namaalbum" => "required|min:1|regex:/[^a-zA-Z0-9]/",
      "deskripsi" => "required|min:1",
    ]);

    $album["NamaAlbum"] = $newData["namaalbum"];
    $album["Deskripsi"] = $newData["deskripsi"];
    $album->save();

    return redirect()
      ->route("gallery.edit", $album)
      ->with("update-success", "Berhasil memperbarui data album !");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id): RedirectResponse
  {
    $album = Album::find($id);
    $foto = [];
    foreach ($album->foto()->get() as $f) {
      array_push($foto, $f);
    }

    foreach ($foto as $f) {
      $splitStr = explode("/", $f["LokasiFile"]);
      $path = join("\\", $splitStr);

      if (!Storage::disk("public")->has($path)) {
        // dd($foto, $f["LokasiFile"], 'Berkas tidak ditemukan !');

        Album::destroy($id);

        return redirect()
          ->route("gallery.index")
          ->with(
            "destroy-success",
            "Berkas yang ingin dihapus sudah tidak ada. Berhasil menghapus album !"
          );
      }

      Storage::disk("public")->delete($path);
    }

    Album::destroy($id);

    return redirect()
      ->route("gallery.index")
      ->with("destroy-success", "Berhasil menghapus album !");
  }
}
