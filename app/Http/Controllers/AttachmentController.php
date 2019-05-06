<?php

namespace App\Http\Controllers;

use App\Entities\Attachments\Attachment;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AttachmentController extends Controller
{

    /**
     * @param Attachment $attachment
     * @return BinaryFileResponse
     */
    public function download(Attachment $attachment): BinaryFileResponse
    {
        return response()->download($attachment->fullPath, $attachment->name);
    }
}
