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
     * Theme Name, without spaces
     * @var string
     */
    private $themeName;

    /**
     * The section to download.
     * @var \App\Section
     */
    private $section;

    /**
     * Section Name, without spaces
     * @var string
     */
    private $sectionName;

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

        $filename = "$this->sectionName.php";

        $contents = $this->files->get(__DIR__ . '/../../Stubs/SectionCustomizer.stub');

        $contents = $this->setupFile($contents);
        $contents = $this->setupSettings($contents);
        $contents = $this->setupControls($contents);

        Storage::disk('public')->put($filename, $contents);

        return response()->download("storage/$filename")
                         ->deleteFileAfterSend(true);
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

        $this->themeName   = str_replace(' ', '', $this->theme->name);
        $this->sectionName = str_replace(' ', '', $this->section->name);
    }

    private function setupFile($contents)
    {
        $contents = $this->replaceCommon($contents);

        return $contents;
    }

    /**
     * Generate the code to register each Customizer Field as a WP Setting.
     *
     * @param $contents
     */
    private function setupSettings($contents)
    {
        $fieldContents = '';

        foreach ($this->fields as $field) {
            $stub = $this->files->get(__DIR__ . '/../../Stubs/Setting.stub');
            $stub = $this->replaceCommon($stub);

            $stub = str_replace('~Default~', "'default' => '$field->default'", $stub) . "\n\n";

            $fieldContents .= $stub;
        }

        return str_replace("~Settings~", $fieldContents, $contents);
    }

    /**
     * Setup the customizer controls.
     *
     * @param $contents
     */
    private function setupControls($contents)
    {
        $controlContents = '';

        foreach ($this->fields as $field) {
            $stub = $this->files->get(__DIR__ . '/../../Stubs/Control.stub');
            $stub = str_replace('~FieldName~', str_replace(' ', '', $field->label), $stub);
            $stub = str_replace('~FieldNameFull~', $field->label, $stub);
            $stub = $this->replaceCommon($stub);

            $controlContents .= $stub . "\n\n";
        }

        return str_replace("~Controls~", $controlContents, $contents);
    }

    /**
     * Replace the common elements in the given stub contents.
     *
     * @param $contents
     */
    private function replaceCommon($contents)
    {
        $contents = str_replace('~ThemeName~', $this->themeName, $contents);
        $contents = str_replace('~SectionName~', $this->sectionName, $contents);
        $contents = str_replace('~SectionNameFull~', $this->section->name, $contents);

        return $contents;
    }
}
