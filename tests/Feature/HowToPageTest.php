<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HowToPageTest extends TestCase
{
    /** @test */
    function it_can_be_viewed() {
    	$this->get('/howto')
		    ->assertStatus(200)
		    ->assertSee('How to Use KickoffWP');
    }
}
