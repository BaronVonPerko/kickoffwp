<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewCustomizerClassPageTest extends TestCase
{
	use DatabaseTransactions;

    /** @test */
    public function it_has_a_page_accessible_by_all_users()
    {
        $this->get('/new')
	        ->assertStatus(200)
	        ->assertSee('Create a new customizer class');
    }
}