<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function index()
    {
        return view('upload_image');
    }

    public function store(Request $request)
    {
        /**
         * FotoID |  JudulFoto |  DeskripsiFoto |  TanggalUnggah | LokasiFile
         */
        $data = $request->validate([
            'judulfoto' => 'required|string|min:1',
            'deskripsifoto' => 'required|string|min:1'
        ]);

        $imageValidationMessage = [
            'image.required' => 'Please upload a file',
            'image.image' => 'Only image files are allowed',
            'image.mimes' => 'Allowed file types: jpg, jpeg, png',
            'image.max' => 'The file may not be greater than 2MB',
        ];

        $request->validate([
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
        ], $imageValidationMessage);

        $uploadedFile = $request->file('image');
        $fileName = time() . "_" . str_replace(' ', '', $uploadedFile->getClientOriginalName());

        // Save file in Storage class
        $path = $uploadedFile->storeAs('upload_files', $fileName, 'public');

        Foto::create([
            'JudulFoto' => $data['judulfoto'],
            'DeskripsiFoto' => $data['deskripsifoto'],
            'TanggalUnggah' => date('d-m-y h:i:s'),
            'LokasiFile' => $path,
            'AlbumID' => 1,
            'UserID' => 1,
        ]);

        return redirect()->back()->with('success', 'File Uploaded Successfully');
    }

    public function viewImage(string $id)
    {
        // $foto = Album::find(1)->get();
        // $foto2 = Foto::find(4);
        // $foto3 = Foto::find(4);

        // dd($foto, $foto2, $foto3->album);

        $foto = Foto::find($id);

        return view('upload_image_view', compact('foto'));
    }
}
