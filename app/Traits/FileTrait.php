<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileTrait {
    
    // Storing File
    public function storeFile($filepath, $file) {

        $data = Storage::disk('s3')->put($filepath, $file);

        return $data;
    }

    // Showing File
    public function showFile($filepath) {
        $file = Storage::disk('s3')->url($filepath);

        return $file;
    }

    // Deleting File
    public function deleteFile($filepath) {

        // Checkingexistance of file
        if(Storage::disk('s3')->exists($filepath)) {

            // Delete File
            Storage::disk('s3')->delete($filepath);
        }

        return true;
    }
}