<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Filesystem\Filesystem;
use App\Theme;
use App\Section;
use App\CustomizerField;
use Illuminate\Support\Facades\Storage;

class GenerateSectionFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files, $themeId, $sectionId)
    {
        $this->files = $files;

        $this->theme   = Theme::find($themeId);
        $this->section = Section::find($sectionId);
        $this->fields  = $this->section->fields;

        $this->themeName   = str_replace(' ', '', $this->theme->name);
        $this->sectionName = str_replace(' ', '', $this->section->name);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filename = "Custom" . "$this->sectionName.php";

        $contents = $this->files->get(__DIR__ . '/../Stubs/SectionCustomizer.stub');
        $contents = $this->replaceCommon($contents);
        $contents = $this->setupSettings($contents);
        $contents = $this->setupControls($contents);

        Storage::disk('public')->put($filename, $contents);

        return $filename;
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
            $stub = $this->files->get(__DIR__ . '/../Stubs/Setting.stub');
            $stub = $this->replaceCommon($stub);

            $fieldName = str_replace(' ', '', $field->label);

            $stub = str_replace('~Default~', "'default' => '$field->default'", $stub) . "\n\n";
            $stub = str_replace('~FieldName~', $fieldName, $stub);

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
            $stub = $this->files->get( __DIR__ . '/../Stubs/TextInputControl.stub' );
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
