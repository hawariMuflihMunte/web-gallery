<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
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
            'tanggaldibuat' => 'required|integer',
        ], $albumMessage);

        $foto = $request->validate([
            'judulfoto' => 'required|string|min:1',
            'deskripsifoto' => 'required|string|min:1',
        ]);

        dd($album, $foto);
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
        //
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
    public function destroy(string $id)
    {
        //
    }
}
