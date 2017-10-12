<?php

namespace Tests\Feature;

use App\Theme;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProfilePageTest extends TestCase {
	use DatabaseTransactions;

	/** @test */
	public function it_has_a_page_that_is_accessible_by_everyone() {
		$this->get( '/profile' )
		     ->assertStatus( 200 )
		     ->assertSee( 'Ready to get started?' );
	}

	/** @test */
	public function it_lists_customizer_classes_for_logged_in_users() {
		$user  = factory( User::class )->create();
		$theme = factory( Theme::class )->create( [ 'user_id' => $user->id ] );

		$this->actingAs( $user )
		     ->get( '/profile' )
		     ->assertSee( $theme->name );
	}
}
