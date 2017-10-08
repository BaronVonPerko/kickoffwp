<?php

namespace Tests\Feature;

use App\CustomizerClass;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomizerFieldsControllerTest extends TestCase {
	use DatabaseTransactions;

	/** @test */
	public function it_has_a_page_to_add_the_fields() {
		$customizer = factory( \App\CustomizerClass::class )->create();

		$this->get( '/fields/' . $customizer->id )->assertStatus( 200 );
	}

	/** @test */
	public function it_will_not_allow_anonymous_users_to_view_a_users_fields() {
		$user       = factory( User::class )->create();
		$customizer = factory( CustomizerClass::class )->create( [ 'user_id' => $user->id ] );

		$this->get( '/fields/' . $customizer->id )->assertStatus( 302 );
	}

	/** @test */
	public function it_allows_a_user_to_see_their_own_fields() {
		$user       = factory( User::class )->create();
		$customizer = factory( CustomizerClass::class )->create( [ 'user_id' => $user->id ] );

		$this->actingAs( $user )->get( '/fields/' . $customizer->id )->assertStatus( 200 );
	}

	/** @test */
	public function it_will_not_allow_a_signed_in_user_to_view_another_users_fields() {
		$user       = factory( User::class )->create();
		$customizer = factory( CustomizerClass::class )->create( [ 'user_id' => $user->id ] );

		$anotherUser = factory( User::class )->create();
		$this->actingAs( $anotherUser )->get( '/fields/' . $customizer->id )->assertStatus( 302 );
	}
}
