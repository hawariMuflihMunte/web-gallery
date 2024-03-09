<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        $user = Auth::user();

        return view("profile.index", compact("user"));
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
        //
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
        $user = Auth::user();
        $changes = [
            "username" => false,
            "email" => false,
            "namalengkap" => false,
            "alamat" => false,
        ];

        if (!is_null($request->input("username"))) {
            $data = $request->validate([
                "username" => "required|string|min:1",
            ]);

            // Check if the user inputs new value or just re-input the existing value
            $checkUpdate = User::where("UserID", $user["UserID"])
                ->where("Username", $data["username"])
                ->get()
                ->first();
            //   dd($checkUpdate);

            if (is_null($checkUpdate)) {
                $update = User::where("UserID", $user["UserID"])->update([
                    "Username" => $data["username"],
                ]);

                if (!($update > 0)) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            "error" =>
                                "Terjadi kesalahan, tidak dapat memperbarui data. Silahkan coba lagi !",
                        ]);
                }

                $changes["username"] = true;
            }
        }

        if (!is_null($request->input("email"))) {
            $data = $request->validate([
                "email" => "required|email:unique",
            ]);

            // Check if the user inputs new value or just re-input the existing value
            $checkUpdate = User::where("UserID", $user["UserID"])
                ->where("Email", $data["email"])
                ->get()
                ->first();
            //   dd($checkUpdate);

            if (is_null($checkUpdate)) {
                $update = User::where("UserID", $user["UserID"])->update([
                    "Email" => $data["email"],
                ]);

                if (!($update > 0)) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            "error" =>
                                "Terjadi kesalahan, tidak dapat memperbarui data. Silahkan coba lagi !",
                        ]);
                }

                $changes["email"] = true;
            }
        }

        if (!is_null($request->input("namalengkap"))) {
            $data = $request->validate([
                "namalengkap" =>
                    'required|string|min:1|regex:/^[a-zA-Z]+(?:[\s,\.]{1,2}[a-zA-Z]+)*$/',
            ]);

            // Check if the user inputs new value or just re-input the existing value
            $checkUpdate = User::where("UserID", $user["UserID"])
                ->where("NamaLengkap", $data["namalengkap"])
                ->get()
                ->first();
            //   dd($checkUpdate);

            if (is_null($checkUpdate)) {
                $update = User::where("UserID", $user["UserID"])->update([
                    "NamaLengkap" => $data["namalengkap"],
                ]);

                if (!($update > 0)) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            "error" =>
                                "Terjadi kesalahan, tidak dapat memperbarui data. Silahkan coba lagi !",
                        ]);
                }

                $changes["namalengkap"] = true;
            }
        }

        if (!is_null($request->input("alamat"))) {
            $data = $request->validate([
                //   "alamat" => 'required|string|min:1|regex:/^[a-zA-Z]+(?:[\s,\.]{1,2}[a-zA-Z]+)*$/',
                "alamat" => "required|string|min:1",
            ]);

            // Check if the user inputs new value or just re-input the existing value
            $checkUpdate = User::where("UserID", $user["UserID"])
                ->where("Alamat", $data["alamat"])
                ->get()
                ->first();
            //   dd($checkUpdate);

            if (is_null($checkUpdate)) {
                $update = User::where("UserID", $user["UserID"])->update([
                    "Alamat" => trim($data["alamat"]),
                ]);

                if (!($update > 0)) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            "error" =>
                                "Terjadi kesalahan, tidak dapat memperbarui data. Silahkan coba lagi !",
                        ]);
                }

                $changes["alamat"] = true;
            }
        }

        if (
            $changes["username"] &&
            $changes["email"] &&
            $changes["namalengkap"]
        ) {
            return redirect()
                ->back()
                ->with([
                    "success" => "Berhasil memperbarui data !",
                ]);
        }

        if ($changes["username"]) {
            return redirect()
                ->back()
                ->with([
                    "success-username" => "Berhasil memperbarui Username !",
                ]);
        }

        if ($changes["email"]) {
            return redirect()
                ->back()
                ->with([
                    "success-email" => "Berhasil memperbarui Email !",
                ]);
        }

        if ($changes["namalengkap"]) {
            return redirect()
                ->back()
                ->with([
                    "success-namalengkap" =>
                        "Berhasil memperbarui Nama Lengkap !",
                ]);
        }

        if ($changes["alamat"]) {
            return redirect()
                ->back()
                ->with([
                    "success-alamat" => "Berhasil memperbarui Alamat !",
                ]);
        }

        return redirect()
            ->back()
            ->withErrors([
                "error" => "Tidak ada data yang diubah !",
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return redirect()
            ->route("login")
            ->with([
                "success-user-delete" => "Berhasil menghapus akun !",
            ]);
    }
}
