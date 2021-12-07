<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadingTrait
{
    /**
     * Upload CV
     *
     * @param $uploadedCv
     * @return string
     */
    public function uploadPdf($uploadedCv): string
    {
        return Storage::disk('public')->putFileAs(
            "cv/" . Str::random(10),
            $uploadedCv,
            $uploadedCv->getClientOriginalName()
        );
    }
}
