<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLogsPageTest extends TestCase
{
	use DatabaseTransactions;

    /** @test */
    function only_admins_can_get_to_logs_page() {
    	$this->get('/admin/logs')
		    ->assertRedirect('/');

    	$user = factory(User::class)->create();

    	$this->actingAs($user)
		    ->get('/admin/logs')
		    ->assertRedirect('/');

    	$admin = factory(User::class)->create(['is_admin' => true]);

    	$this->actingAs($admin)
		    ->get('/admin/logs')
		    ->assertStatus(200);
    }
}
