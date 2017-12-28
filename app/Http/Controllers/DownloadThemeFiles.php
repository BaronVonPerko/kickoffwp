<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateSectionFile;
use App\Theme;
use App\Traits\ProtectCustomizerClassTrait;
use Chumper\Zipper\Zipper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class DownloadThemeFiles extends Controller
{
	use ProtectCustomizerClassTrait;

    public function __invoke(Filesystem $files, $themeId) {
    	$theme = Theme::find($themeId);
    	$sections = $theme->sections()->get();
    	$filenames = [];

		if(!$this->checkUserAccess($theme)) return;

    	foreach($sections as $section) {
    		$sectionId = $section->id;
		    $generator = new GenerateSectionFile($files, $themeId, $sectionId);
		    $filenames[] = "storage/" . $generator->handle();
	    }

	    $zipper = new Zipper();
	    $zipper->make('storage/' . $theme->name . '.zip')
		    ->add($filenames)
		    ->close();

	    return response()->download('storage/' . $theme->name . '.zip')
	                     ->deleteFileAfterSend(true);
    }
}
