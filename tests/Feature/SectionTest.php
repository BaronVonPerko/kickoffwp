<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use \App\Theme;

class SectionTest extends TestCase {
	use DatabaseTransactions;


	/** @test */
	public function it_can_save_a_section_to_a_theme() {
		$theme = factory( Theme::class )->create();

		$this->post( "/theme/$theme->id/sections", ["name" => "Test Section"] );

		$sections = Theme::find($theme->id)->sections;

		$this->assertEquals(1, $sections->count());
    }
}
