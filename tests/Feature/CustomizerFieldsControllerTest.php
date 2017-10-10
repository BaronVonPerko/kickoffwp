<?php

namespace Tests\Feature;

use App\CustomizerClass;
use App\CustomizerField;
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

	/** @test */
	public function it_can_create_a_new_field() {
		$customizer = factory( CustomizerClass::class )->create();

		$this->post( '/fields/' . $customizer->id . '/create', [
			"label"   => "My Field",
			"default" => "#00ff00",
		] )->assertStatus( 200 );

		$savedField = CustomizerField::Class( $customizer->id )->first();

		$this->assertEquals( "My Field", $savedField->label );
		$this->assertEquals( "#00ff00", $savedField->default );
	}

	/** @test */
	public function it_wont_let_anonymous_users_add_to_other_users_class() {
		$user       = factory( User::class )->create();
		$customizer = factory( CustomizerClass::class )->create( [ 'user_id' => $user->id ] );

		$this->post( '/fields/' . $customizer->id . '/create', [
			"label"   => "My Field",
			"default" => "#00ff00",
			"classId" => $customizer->id,
		] )->assertStatus( 302 );
	}

	/** @test */
	public function it_wont_allow_users_to_create_on_other_users_class() {
		$user       = factory( User::class )->create();
		$customizer = factory( CustomizerClass::class )->create( [ 'user_id' => $user->id ] );

		$anotherUser = factory(User::class)->create();
		$this->actingAs($anotherUser)->post( '/fields/' . $customizer->id . '/create', [
			"label"   => "My Field",
			"default" => "#00ff00",
			"classId" => $customizer->id,
		] )->assertStatus( 302 );

		$this->actingAs($user)->post( '/fields/' . $customizer->id . '/create', [
			"label"   => "My Field",
			"default" => "#00ff00",
			"classId" => $customizer->id,
		] )->assertStatus( 200 );
	}
}
