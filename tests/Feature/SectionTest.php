<?php

namespace Tests\Feature;

use App\Section;
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
		     ->assertJson( [ "success" => false, "message" => "Invalid Theme ID" ] );

		$this->assertEquals( 1, $theme->fresh()->sections->count() );
	}

	/** @test */
	function a_section_can_be_updated() {
		$section = factory( Section::class )->create();

		$this->put( "/theme/$section->theme_id/sections/$section->id", [ "name" => "Updated" ] )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => true ] );

		$this->assertEquals( "Updated", $section->fresh()->name );
	}

	/** @test */
	function a_user_can_only_edit_their_own_sections() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ "user_id" => $user->id ] );
		$section = factory( Section::class )->create( [ "theme_id" => $theme->id ] );

		$this->put( "/theme/$theme->id/sections/$section->id", [ "name" => "Updated" ] )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid Section ID" ] );

		$this->assertNotEquals( "Updated", $section->fresh()->name );

		$this->actingAs( $user )
		     ->put( "/theme/$theme->id/sections/$section->id", [ "name" => "Updated" ] )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => true ] );

		$this->assertEquals( "Updated", $section->fresh()->name );

		$anotherUser = factory( User::class )->create();

		$this->actingAs( $anotherUser )
		     ->put( "/theme/$theme->id/sections/$section->id", [ "name" => "Another Update" ] )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid Section ID" ] );

		$this->assertNotEquals( "Another Update", $section->fresh()->name );
	}
}
