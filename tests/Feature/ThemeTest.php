<?php

namespace Tests\Feature;

use App\Theme;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThemeTest extends TestCase {
	use DatabaseTransactions;

	/** @test */
	function it_can_save_a_new_theme() {
		$count = Theme::where( 'name', 'Test Theme' )->count();
		$this->assertEquals( 0, $count );

		$this->post( '/theme', [ "name" => "Test Theme" ] );

		$count = Theme::where( 'name', 'Test Theme' )->count();
		$this->assertEquals( 1, $count );
	}

	/** @test */
	function it_can_delete_an_unowned_theme() {
		$theme = factory( Theme::class )->create( [ 'user_id' => null ] );

		$this->delete( "/theme/$theme->id" )
		     ->assertJson( [ "success" => true ] );


		$this->assertNull( $theme->fresh() );
	}

	/** @test */
	function a_user_can_delete_their_own_theme() {
		$user  = factory( User::class )->create();
		$theme = factory( Theme::class )->create( [ 'user_id' => $user->id ] );

		$this->actingAs( $user )
		     ->delete( "/theme/$theme->id" )
		     ->assertJson( [ "success" => true ] );

		$this->assertNull( $theme->fresh() );
	}

	/** @test */
	function anonymous_user_cannot_delete_a_theme_owned_by_a_user() {
		$user  = factory( User::class )->create();
		$theme = factory( Theme::class )->create( [ 'user_id' => $user->id ] );

		$this->delete( "/theme/$theme->id" )
		     ->assertJson( [ "success" => false, "message" => "Invalid Theme ID" ] );

		$this->assertNotNull( $theme->fresh() );
	}

	/** @test */
	function a_user_cannot_delete_another_users_theme() {
		$user  = factory( User::class )->create();
		$theme = factory( Theme::class )->create( [ 'user_id' => $user->id ] );

		$anotherUser = factory( User::class )->create();

		$this->actingAs($anotherUser)
			->delete("/theme/$theme->id")
			->assertJson([ "success" => false, "message" => "Invalid Theme ID" ]);

		$this->assertNotNull($theme->fresh());
	}
}
