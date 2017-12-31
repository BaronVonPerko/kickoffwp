<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    /** @test */
    function only_admin_users_can_access_dashboard() {
    	$this->get('/admin/dashboard')
		    ->assertRedirect('/');

    	$user = factory(User::class)->create();

    	$this->actingAs($user)
		    ->get('/admin/dashboard')
		    ->assertRedirect('/');

    	$this->actingAs($this->getAdminUser())
		    ->get('/admin/dashboard')
		    ->assertStatus(200)
		    ->assertSee('Admin Dashboard');
    }

    private function getAdminUser() {
    	return factory(User::class)->create(['is_admin' => true]);
    }
}
