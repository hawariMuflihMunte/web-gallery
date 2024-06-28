<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\LikeFoto;
use Illuminate\Http\Request;

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
        $userID = auth()->id();
        $slug = $request->input("slug");
        $currentDate = date("Y-m-d");

        $foto = Foto::firstWhere("slug", $slug);

        LikeFoto::create([
            "FotoID" => $foto['FotoID'],
            "UserID" => $userID,
            "TanggalLike" => $currentDate,
        ]);

        return redirect()
            ->route("foto.show", $slug)
            ->with(["liked" => __('app.liked')]);
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
        $likefoto = LikeFoto::firstWhere(["LikeID" => $id]);
        $foto = $likefoto->photo()->first();

        $likefoto->delete();

        return redirect()
            ->route("foto.show", $foto['slug'])
            ->with(["unlike" => __('app.unlike')]);
    }
}
