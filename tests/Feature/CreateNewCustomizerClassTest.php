<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateNewCustomizerClassTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function it_can_save_a_new_customizer_class()
    {
	    $count = \App\CustomizerClass::where('theme_name', 'Test Theme')->count();
	    $this->assertEquals(0, $count);

        $data = [
            "theme_name" => "Test Theme",
	        "section_name" => "Test Section"
        ];

        $this->post('/new', $data)->assertStatus(200);

        $count = \App\CustomizerClass::where('theme_name', 'Test Theme')->count();
        $this->assertEquals(1, $count);
    }
}
