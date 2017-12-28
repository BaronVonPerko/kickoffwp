<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageTest extends TestCase
{
    /** @test */
    function it_shows_the_welcome_page() {
    	$this->get('/')
		    ->assertStatus(200)
		    ->assertSee('Kick off your WordPress Theme Customizer Files');
    }
}
