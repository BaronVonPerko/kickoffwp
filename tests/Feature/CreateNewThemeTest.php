<?php

namespace Tests\Feature;

use App\Theme;
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
	    $count = Theme::where('name', 'Test Theme')->count();
	    $this->assertEquals(0, $count);

        $this->post('/theme', ["name" => "Test Theme"]);

        $count = Theme::where('name', 'Test Theme')->count();
        $this->assertEquals(1, $count);
    }
}
