<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateSectionFile;
use Illuminate\Filesystem\Filesystem;

class DownloadSectionFile extends Controller
{
    public function __invoke(Filesystem $files, $themeId, $sectionId)
    {
        $generator = new GenerateSectionFile($files, $themeId, $sectionId);
        $filename = $generator->handle();

        return response()->download("storage/$filename")
                         ->deleteFileAfterSend(true);
    }
}
