<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use \App\Theme;

class SectionTest extends TestCase {
	use DatabaseTransactions;


	/** @test */
	function it_can_save_a_section_to_a_theme() {
		$theme = factory( Theme::class )->create();

		$this->post( "/theme/$theme->id/sections", [ "name" => "Test Section" ] );

		$sections = Theme::find( $theme->id )->sections;

		$this->assertEquals( 1, $sections->count() );
	}

	/** @test */
	function a_user_can_only_create_a_section_on_their_own_theme() {
		$user  = factory( User::class )->create();
		$theme = factory( Theme::class )->create( [ "user_id" => $user->id ] );

		$this->post( "/theme/$theme->id/sections", [ "name" => "Test Section" ] )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid Theme ID" ] );

		$this->assertEquals( 0, $theme->sections->count() );

		$this->actingAs( $user )
		     ->post( "/theme/$theme->id/sections", [ "name" => "Test Section" ] )
		     ->assertStatus( 302 );

		$this->assertEquals( 1, $theme->fresh()->sections->count() );

		$anotherUser = factory( User::class )->create();

		$this->actingAs( $anotherUser )
		     ->post( "/theme/$theme->id/sections", [ "name" => "Test Section" ] )
		     ->assertStatus( 200 )
		     ->assertJson(["success" => false, "message" => "Invalid Theme ID"]);

		$this->assertEquals( 1, $theme->fresh()->sections->count() );
	}
}
