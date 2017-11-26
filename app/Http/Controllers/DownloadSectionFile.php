<?php

namespace App\Http\Controllers;

use App\Section;
use App\Theme;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DownloadSectionFile extends Controller
{
    /**
     * The filesystem instance.
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;

    /**
     * The theme for the given section.
     * @var \App\Theme
     */
    private $theme;

    /**
     * The section to download.
     * @var \App\Section
     */
    private $section;

    /**
     * Collection of fields on the given section.
     * @var \App\CustomizerField
     */
    private $fields;

    /**
     * Download the section file.
     *
     * @param Filesystem $files
     */
    public function __invoke(Filesystem $files, $themeId, $sectionId)
    {
        $this->files = $files;

        $this->getObjects($themeId, $sectionId);

        $filename = str_replace(" ", "", $this->section->name) . ".php";

        Storage::disk('public')->put($filename, 'hello world');
        return response()->download("storage/$filename")
                         ->deleteFileAfterSend(true);

//        $this->files->put("public/files/test.txt", "hello world");
//        return response()->download("images/code-screenshot.png");
    }

    /**
     * Get the objects for the given IDs.
     *
     * @param $themeId
     * @param $sectionId
     */
    private function getObjects($themeId, $sectionId)
    {
        $this->theme   = Theme::find($themeId);
        $this->section = Section::find($sectionId);
        $this->fields  = $this->section->fields;
    }
}
