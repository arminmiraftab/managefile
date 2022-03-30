<?php

namespace App\Repository\Services;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Storage;

trait UploadImage
{
    public function storeImage($imageData){
        $value= Storage::disk('public')->putFile('images',$imageData);
        return $value !== null ? Storage::url($value) : $value ;
    }
}
