<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilePageTest extends TestCase
{
    /** @test */
    public function it_has_a_page_that_is_accessible_by_everyone()
    {
        $this->get('/profile')
             ->assertStatus(200)
             ->assertSee('Ready to get started?');
    }
}
