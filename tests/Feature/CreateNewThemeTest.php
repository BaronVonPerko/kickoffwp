<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateNewThemeTest extends TestCase
{
	use DatabaseTransactions;

    /** @test */
    public function it_can_save_a_new_theme()
    {
	    $count = \App\Theme::where('name', 'Test Theme')->count();
	    $this->assertEquals(0, $count);

        $this->post('/theme/new', ["name" => "Test Theme"]);

        $count = \App\Theme::where('name', 'Test Theme')->count();
        $this->assertEquals(1, $count);
    }
}
