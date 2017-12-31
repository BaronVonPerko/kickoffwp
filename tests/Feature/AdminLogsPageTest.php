<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLogsPageTest extends TestCase
{
    /** @test */
    function only_admins_can_get_to_logs_page() {
    	$this->get('/logs')
		    ->assertRedirect('/');

    	$user = factory(User::class)->create();

    	$this->actingAs($user)
		    ->get('/logs')
		    ->assertRedirect('/');

    	$admin = factory(User::class)->create(['is_admin' => true]);

    	$this->actingAs($admin)
		    ->get('/logs')
		    ->assertStatus(200);
    }
}
