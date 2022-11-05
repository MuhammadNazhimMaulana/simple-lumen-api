<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileTrait {
    
    // Storing Image
    public function storeFile($filepath, $file) {

        $data = Storage::disk('s3')->put($filepath, $file);

        return $data;
    }

    // Showing Image
    public function showFile($filepath) {
        $image = Storage::disk('s3')->url($filepath);

        return $image;
    }
}