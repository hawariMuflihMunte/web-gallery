<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadManager extends Controller
{
    public function upload() {
        return view('upload');
    }

    public function uploadPost(Request $request) {
        $file = $request->file('file');

        echo "File name: ".$file->getClientOriginalName()."<br/>";
        echo "File name: ".$file->getClientOriginalExtension()."<br/>";
        echo "File name: ".$file->getRealPath()."<br/>";
        echo "File name: ".$file->getSize()."<br/>";
        echo "File name: ".$file->getMimeType()."<br/>";

        $destinationPath = "uploads";

        if ($file->move($destinationPath, $file->getClientOriginalName())) {
            echo "File upload success";
        } else {
            echo "File upload failed";
        }
    }
}
