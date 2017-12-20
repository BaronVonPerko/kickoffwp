<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateSectionFile;
use App\Theme;
use Chumper\Zipper\Zipper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class DownloadThemeFiles extends Controller
{
    public function __invoke(Filesystem $files, $themeId) {
    	$theme = Theme::find($themeId);
    	$sections = $theme->sections()->get();
    	$filenames = [];


    	foreach($sections as $section) {
    		$sectionId = $section->id;
		    $generator = new GenerateSectionFile($files, $themeId, $sectionId);
		    $filenames[] = "storage/" . $generator->handle();
	    }

	    $zipper = new Zipper();
	    $zipper->make('storage/' . $theme->id . '.zip')
		    ->add($filenames)
		    ->close();

	    return response()->download('storage/' . $theme->id . '.zip')
	                     ->deleteFileAfterSend(true);
    }
}
