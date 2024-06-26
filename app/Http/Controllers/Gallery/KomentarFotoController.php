<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\KomentarFoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KomentarFotoController extends Controller
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
    public function store(Request $request): RedirectResponse
    {
        $commentMessage = [
            "isikomentar.required" => "Komentar tidak boleh kosong !",
            "isikomentar.min" => "Minimal 1 karakter",
        ];

        $comment = $request->validate(
            [
                "fotoid" => "required",
                "isikomentar" => "required|string|min:1",
            ],
            $commentMessage
        );

        $currentDate = date("Y-m-d");

        $newComment = KomentarFoto::create([
            "FotoID" => $comment["fotoid"],
            "UserID" => auth()->id(),
            "IsiKomentar" => $comment["isikomentar"],
            "TanggalKomentar" => $currentDate,
        ]);

        $foto = $newComment->photo()->first();

        return redirect()
            ->route("foto.show", $foto["slug"])
            ->with([
                "success-comment" => "Berhasil menambah komentar !",
            ]);
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
