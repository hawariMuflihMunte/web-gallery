<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeFotoController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

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
        $userID = Auth::id();
        $fotoID = $request->input("fotoid");
        $currentDate = date("Y-m-d");

        LikeFoto::create([
            "FotoID" => $fotoID,
            "UserID" => $userID,
            "TanggalLike" => $currentDate,
        ]);

        $foto = Foto::find($fotoID);

        return redirect()
            ->route("foto.edit", [
                "foto" => $foto,
            ])
            ->with("like-success", "Berhasil memberikan like !");
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
        $likefoto = LikeFoto::find($id);
        $foto = $likefoto->foto()->get()->first();

        LikeFoto::destroy($id);

        return redirect()
            ->route("foto.edit", [
                "foto" => $foto,
            ])
            ->with("unlike-success", "Berhasil menghapus like !");
    }
}
