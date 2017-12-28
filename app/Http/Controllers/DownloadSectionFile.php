<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateSectionFile;
use App\Traits\ProtectCustomizerClassTrait;
use Illuminate\Filesystem\Filesystem;

class DownloadSectionFile extends Controller
{
	use ProtectCustomizerClassTrait;

    public function __invoke(Filesystem $files, $themeId, $sectionId)
    {
    	if(!$this->checkUserAccess($themeId)) return;

        $generator = new GenerateSectionFile($files, $themeId, $sectionId);
        $filename = $generator->handle();

        return response()->download("storage/$filename")
                         ->deleteFileAfterSend(true);
    }
}
