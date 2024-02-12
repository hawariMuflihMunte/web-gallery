<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function index()
    {
        return view('upload_image');
    }

    public function store(Request $request)
    {
        $messages = [
            'image.required' => 'Please upload a file',
            'image.image' => 'Only image files are allowed',
            'image.mimes' => 'Allowed file types: jpg, png, gif',
            'image.max' => 'The file may not be greater than 2MB',
        ];

        $request->validate([
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
        ], $messages);

        $uploadedFile = $request->file('image');
        $fileName = time() . "_" . $uploadedFile->getClientOriginalName();

        // Save file in Storage class
        $uploadedFile->storeAs('upload_files', $fileName, 'public');

        // Move file into 'upload_files' folder in public/
        $request->image->move(public_path('upload_files'), $fileName);

        return redirect()->back()->with('success', 'File Uploaded Successfully');
    }
}
