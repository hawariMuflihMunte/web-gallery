<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all('AlbumID', 'NamaAlbum');

        return view('home', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $albumMessage = [
            'namaalbum.min' => 'Masukkan minimal 1 karakter !',
            'deskripsi.min' => 'Masukkan minimal 1 karakter !',
        ];

        $album = $request->validate([
            'namaalbum' => 'required|string|min:1',
            'deskripsi' => 'required|string|min:1',
        ], $albumMessage);

        $foto = $request->validate([
            'judulfoto' => 'required|min:1',
            'deskripsifoto' => 'required|min:1',
        ]);

        $imagesMessage = [
            'images.max' => 'Ukuran maksimal file adalah 2MB !'
        ];

        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], $imagesMessage);

        // dd($request->file('images')[0]->getClientOriginalName(), $request->file('images'));

        $currentDate = date('Y-m-d');
        $currentUserID = Auth::id();

        $newAlbum = Album::create([
            'NamaAlbum' => $album['namaalbum'],
            'Deskripsi' => $album['deskripsi'],
            'TanggalDibuat' => $currentDate,
            'UserID' => $currentUserID,
        ]);

        $currentAlbumID = $newAlbum['AlbumID'];

        for ($i = 0; $i < count($foto) - 1; $i++) {
            $filename = preg_replace('/[^a-zA-Z0-9]/', "", strtolower($request->file('images')[$i]->getClientOriginalName()));
            $extension = $request->file('images')[$i]->getClientOriginalExtension();
            $filenameWithoutExtension = str_replace($extension, '', $filename);
            $filenameWithExtension = $filenameWithoutExtension.".".$extension;
            $filterAlbum = preg_replace('/[^a-zA-Z0-9]/', "", strtolower($album['namaalbum']));
            $filepath = $request->file('images')[$i]->storeAs($filterAlbum, $filenameWithExtension, 'public');

            // dd($filename, $filenameWithoutExtension, $filenameWithExtension, $filepath);

            Foto::create([
                'JudulFoto' => $foto['judulfoto'][$i],
                'DeskripsiFoto' => $foto ['deskripsifoto'][$i],
                'TanggalUnggah' => $currentDate,
                'LokasiFile' => $filepath,
                'AlbumID' => $currentAlbumID,
                'UserID' => $currentUserID,
            ]);
        }

        return redirect()->route('gallery.index')->with('insert-success', 'Berhasil menambahkan album baru !');
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
    public function edit(string $id)
    {
        $album = Album::find($id);
        $foto = $album->foto()->get();

        return view('gallery.details', compact('album', 'foto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = Album::find($id);

        $newData = $request->validate([
            'namaalbum' => 'required|min:1|regex:/[^a-zA-Z0-9]/',
            'deskripsi' => 'required|min:1',
        ]);

        $album['NamaAlbum'] = $newData['namaalbum'];
        $album['Deskripsi'] = $newData['deskripsi'];
        $album->save();

        return redirect()->route('gallery.edit', $album)->with('update-success', 'Berhasil memperbarui data album !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Album::destroy($id);

        return redirect()->route('gallery.index')->with('destroy-success', 'Berhasil menghapus album !');
    }
}
