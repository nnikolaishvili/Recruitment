<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadingTrait
{
    /**
     * Upload CV
     *
     * @param $file
     * @return string
     */
    public function uploadCv($file): string
    {
        return Storage::disk('public')->putFileAs(
            "cv/" . Str::random(10),
            $file,
            $file->getClientOriginalName()
        );
    }
}
