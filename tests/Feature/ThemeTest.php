<?php

namespace Tests\Feature;

use App\CustomizerField;
use App\Section;
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


		$this->assertNotNull( $theme->fresh()->deleted_at );
	}

	/** @test */
	function a_user_can_delete_their_own_theme() {
		$user  = factory( User::class )->create();
		$theme = factory( Theme::class )->create( [ 'user_id' => $user->id ] );

		$this->actingAs( $user )
		     ->delete( "/theme/$theme->id" )
		     ->assertJson( [ "success" => true ] );

		$this->assertNotNull( $theme->fresh()->deleted_at );
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

		$this->actingAs( $anotherUser )
		     ->delete( "/theme/$theme->id" )
		     ->assertJson( [ "success" => false, "message" => "Invalid Theme ID" ] );

		$this->assertNotNull( $theme->fresh() );
	}

	/** @test */
	function deleting_a_theme_also_deletes_sections() {
		$theme    = factory( Theme::class )->create();
		$sections = factory( Section::class, 3 )->create( [ "theme_id" => $theme->id ] );

		$this->delete( "/theme/$theme->id" );

		$this->assertNotNull( $theme->fresh()->deleted_at );
		$this->assertNull( $sections->fresh()[0] );
		$this->assertNull( $sections->fresh()[1] );
		$this->assertNull( $sections->fresh()[2] );
	}

	/** @test */
	function deleting_a_theme_deletes_all_fields_in_all_sections() {
		$theme    = factory( Theme::class )->create();
		$sections = factory( Section::class, 3 )->create( [ "theme_id" => $theme->id ] );
		$fields1  = factory( CustomizerField::class, 2 )->create( [ "section_id" => $sections[0]->id ] );
		$fields2  = factory( CustomizerField::class )->create( [ "section_id" => $sections[2]->id ] );

		$this->delete( "/theme/$theme->id" );

		$this->assertNotNull( $theme->fresh()->deleted_at );
		$this->assertNull( $sections->fresh()[0] );
		$this->assertNull( $sections->fresh()[1] );
		$this->assertNull( $sections->fresh()[2] );
		$this->assertNull( $fields1->fresh()[0] );
		$this->assertNull( $fields1->fresh()[1] );
		$this->assertNull( $fields2->fresh() );
	}

	/** @test */
	function it_can_edit_a_theme_name() {
		$theme = factory( Theme::class )->create();

		$this->put( "/theme/$theme->id", [ "name" => "Updated Name" ] )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => true ] );

		$this->assertEquals( "Updated Name", $theme->fresh()->name );
	}

	/** @test */
	function anonymous_users_cannot_update_user_themes() {
		$user = factory(User::class)->create();
		$theme = factory(Theme::class)->create(["user_id" => $user->id]);

		$this->put("/theme/$theme->id", ["name" => "Something"])
			->assertStatus(200)
			->assertJson(["success" => false, "message" => "Invalid Theme ID"]);

		$this->assertNotEquals("Something", $theme->fresh()->name);
	}

	/** @test */
	function a_user_cannot_update_another_user_theme() {
		$user = factory(User::class)->create();
		$theme = factory(Theme::class)->create(["user_id" => $user->id]);

		$anotherUser = factory(User::class)->create();

		$this->actingAs($anotherUser)
		     ->put("/theme/$theme->id", ["name" => "Something"])
		     ->assertStatus(200)
		     ->assertJson(["success" => false, "message" => "Invalid Theme ID"]);

		$this->assertNotEquals("Something", $theme->fresh()->name);
	}

	/** @test */
	function a_user_can_update_their_own_theme() {
		$user = factory(User::class)->create();
		$theme = factory(Theme::class)->create(["user_id" => $user->id]);

		$this->actingAs($user)
		     ->put("/theme/$theme->id", ["name" => "Something"])
		     ->assertStatus(200)
		     ->assertJson(["success" => true]);

		$this->assertEquals("Something", $theme->fresh()->name);
	}

	/** @test */
	function deleted_themes_can_be_found_in_trash() {
		$theme = factory(Theme::class)->create();

		$theme->delete();

		$this->assertContains($theme->id, Theme::withTrashed()->get()->pluck('id'));
	}
}
