<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $albums = Album::all()->sortByDesc("TanggalDibuat");

        return view("pages.album-index", compact("albums"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.album-add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $album = $request->validate([
            "namaalbum" => "required|string|min:1",
            "deskripsi" => "required|string|min:1",
        ], [
            "namaalbum.min" => "Masukkan minimal 1 karakter !",
            "deskripsi.min" => "Masukkan minimal 1 karakter !",
        ]);

        $currentDate = date("Y-m-d");
        $currentUserID = auth()->id();

        $newAlbum = Album::create([
            "NamaAlbum" => $album["namaalbum"],
            "Deskripsi" => $album["deskripsi"],
            "TanggalDibuat" => $currentDate,
            "UserID" => $currentUserID,
        ]);

        $foto = $request->validate([
            "judulfoto" => "required|min:1",
            "deskripsifoto" => "required|min:1",
        ]);

        $request->validate([
            "images" => "required|array",
            "images.*" => "required|mimes:jpg,jpeg,png|max:2048",
        ], [
            "images.max" => "Ukuran maksimal file adalah 2MB !",
        ]);

        $images = $request->file("images");

        $i = 0;
        foreach ($images as $image) {
            $sanitizedImage = strtotime($newAlbum['TanggalDibuat']).random_int(0, 999999).'.'.strtolower($image->getClientOriginalExtension());
            $filterAlbum = preg_replace(
                "/[^a-zA-Z0-9]/",
                "",
                strtolower($newAlbum["NamaAlbum"])
            );
            $filepath = $image
                ->storeAs($filterAlbum, $sanitizedImage, "public");

            Foto::create([
                "JudulFoto" => $foto["judulfoto"][$i],
                "DeskripsiFoto" => $foto["deskripsifoto"][$i],
                "TanggalUnggah" => $currentDate,
                "LokasiFile" => $filepath,
                "AlbumID" => $newAlbum["AlbumID"],
                "UserID" => $currentUserID,
            ]);

            $i++;
        }

        return redirect()
            ->route("album.index")
            ->with([
                "album-add-success" => __('app.album-add-success'),
            ]);
    }

    /**
     * Show albums of the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function show(User $user): View
    {
        $user = auth()->user();
        $albums = $user->albums;

        return view("pages.album-show", compact("albums", "user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album): View
    {
        $photos = $album->photos()->get();

        $currentUserId = auth()->id();
        $albumOwnerId = $album->UserID;

        // Check if the current user is the owner of the album
        $editable = $currentUserId == $albumOwnerId;

        /**
         * This feature will be used the near future. Move this code to
         * `UserController` to display the proper profile pictures for
         * the authenticated user.
         */

        // $defaultMaleProfilePicture = asset('images/users/dummy/boy.png');
        // $defaultFemaleProfilePicture = asset('images/users/dummy/girl.png');

        // $profilePicture = $user->profile_picture ?: ($user->gender == 'male' ? $defaultMaleProfilePicture : $defaultFemaleProfilePicture);

        return view(
            "pages.album-details",
            compact("album", "photos", "editable")
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $newData = $request->validate([
            "namaalbum" => "required|min:1|regex:/[^a-zA-Z0-9]/",
            "deskripsi" => "required|min:1",
        ]);

        $album["NamaAlbum"] = $newData["namaalbum"];
        $album["Deskripsi"] = $newData["deskripsi"];
        $album->save();

        return redirect()
            ->route("album.edit", $album["slug"])
            ->with([
                "album-update-success" => __('app.album-update-success'),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album): RedirectResponse
    {
        $photos = $album->photos()->pluck('LokasiFile');

        // Delete photos from storage
        Storage::disk('public')->delete($photos->toArray());

        // Delete album and photos
        $album->delete();

        return redirect()
            ->route("album.index")
            ->with([
                "album-delete-success" => __('app.album-delete-success'),
            ]);
    }
}
