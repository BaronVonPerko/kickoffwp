<?php

namespace Tests\Feature;

use App\CustomizerField;
use App\FieldType;
use App\Section;
use App\Theme;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CustomizerFieldTest extends TestCase {
	use DatabaseTransactions;

	/** @test */
	public function it_has_a_page_to_add_the_fields() {
		$owner = factory(User::class)->create();
		$theme = factory(Theme::class)->create(['user_id' => $owner->id]);
		$section = factory( Section::class )->create(['theme_id' => $theme->id]);

		$this->get( "/theme/$section->theme_id/sections/$section->id/fields" )->assertStatus( 302 );

		$this->actingAs($owner)
			->get("/theme/$section->theme_id/sections/$section->id/fields")->assertStatus(200);
	}

	/** @test */
	public function it_will_not_allow_anonymous_users_to_view_a_users_fields() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ 'user_id' => $user->id ] );
		$section = factory( Section::class )->create( [ 'theme_id' => $theme->id ] );

		$this->get( "/theme/$theme->id/sections/$section->id/fields" )->assertStatus( 302 );
	}

	/** @test */
	public function it_allows_a_user_to_see_their_own_fields() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ 'user_id' => $user->id ] );
		$section = factory( Section::class )->create( [ 'theme_id' => $theme->id ] );

		$this->actingAs( $user )->get( "/theme/$theme->id/sections/$section->id/fields" )->assertStatus( 200 );
	}

	/** @test */
	public function it_will_not_allow_a_signed_in_user_to_view_another_users_fields() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ 'user_id' => $user->id ] );
		$section = factory( Section::class )->create( [ 'theme_id' => $theme->id ] );

		$anotherUser = factory( User::class )->create();
		$this->actingAs( $anotherUser )->get( "/theme/$theme->id/sections/$section->id/fields" )->assertStatus( 302 );
	}

	/** @test */
	public function it_can_create_a_new_field() {
		$owner = factory(User::class)->create();
		$theme = factory(Theme::class)->create(['user_id' => $owner->id]);
		$section = factory( Section::class )->create(['theme_id' => $theme->id]);

		$this->post( "/theme/$section->theme_id/sections/$section->id/fields", [
			"label"   => "My Field",
			"default" => "#00ff00",
			"type_id" => 1,
		] )->assertStatus( 302 );

		$this->actingAs($owner)->post( "/theme/$section->theme_id/sections/$section->id/fields", [
			"label"   => "My Field",
			"default" => "#00ff00",
			"type_id" => 1,
		] )->assertStatus( 200 );

		$savedField = CustomizerField::Section( $section->id )->first();

		$this->assertEquals( "My Field", $savedField->label );
		$this->assertEquals( "#00ff00", $savedField->default );
	}

	/** @test */
	public function it_wont_let_anonymous_users_add_to_other_users_class() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ 'user_id' => $user->id ] );
		$section = factory( Section::class )->create( [ 'theme_id' => $theme->id ] );

		$this->post( "/theme/$section->theme_id/sections/$section->id/fields", [
			"label"      => "My Field",
			"default"    => "#00ff00",
			"section_id" => $section->id,
		] )->assertStatus( 302 );
	}

	/** @test */
	public function it_wont_allow_users_to_create_on_other_users_class() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ 'user_id' => $user->id ] );
		$section = factory( Section::class )->create();

		$anotherUser = factory( User::class )->create();
		$this->actingAs( $anotherUser )->post( "/theme/$theme->id/sections/$section->id/fields", [
			"label"      => "My Field",
			"default"    => "#00ff00",
			"section_id" => $section->id,
			"type_id"    => 1,
		] )->assertStatus( 302 );

		$this->actingAs( $user )->post( "/theme/$theme->id/sections/$section->id/fields", [
			"label"      => "My Field",
			"default"    => "#00ff00",
			"section_id" => $section->id,
			"type_id"    => 1,
		] )->assertStatus( 200 );
	}

	function it_should_have_a_type() {
		$type = FieldType::first();

		$field = factory( CustomizerField::class )->create( [ 'type_id' => $type->id ] );

		$this->assertEquals( $type, $field->type );
	}

	/** @test */
	function it_can_be_updated() {
		$owner = factory(User::class)->create();
		$theme = factory(Theme::class)->create(['user_id' => $owner->id]);
		$section = factory( Section::class )->create(['theme_id' => $theme->id]);
		$field   = factory( CustomizerField::class )->create( [ 'section_id' => $section->id ] );

		$this->put( "/theme/$section->theme_id/sections/$section->id/fields/$field->id", [
			"label"   => "Updated",
			"default" => "Some text",
		] )->assertStatus( 302 );

		$this->actingAs($owner)->put( "/theme/$section->theme_id/sections/$section->id/fields/$field->id", [
			"label"   => "Updated",
			"default" => "Some text",
		] )->assertStatus( 200 )
		     ->assertJson( [ "success" => true ] );

		$this->assertEquals( "Updated", $field->fresh()->label );
		$this->assertEquals( "Some text", $field->fresh()->default );
	}

	/** @test */
	function it_requires_matching_section_and_theme_ids_to_update() {
		$owner = factory(User::class)->create();
		$theme = factory(Theme::class)->create(['user_id' => $owner->id]);
		$section = factory( Section::class )->create(['theme_id' => $theme->id]);
		$field   = factory( CustomizerField::class )->create( [ 'section_id' => $section->id ] );

		$badThemeId   = $section->theme_id + 1;
		$badSectionId = $section->id + 1;

		$this->put( "/theme/$badThemeId/sections/$section->id/fields/$field->id", [
			"label" => "Updated",
		] )->assertStatus( 302 );

		$this->actingAs($owner)->put( "/theme/$badThemeId/sections/$section->id/fields/$field->id", [
			"label" => "Updated",
		] )->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid ID" ] );

		$this->assertNotEquals( "Updated", $field->fresh()->label );

		$this->put( "/theme/$section->theme_id/sections/$badThemeId/fields/$field->id", [
			"label" => "Updated",
		] )->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid ID" ] );

		$this->assertNotEquals( "Updated", $field->fresh()->label );
	}

	/** @test */
	function it_requires_a_matching_userid_if_not_anonymous_to_update() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ "user_id" => $user->id ] );
		$section = factory( Section::class )->create( [ "theme_id" => $theme->id ] );
		$field   = factory( CustomizerField::class )->create( [ 'section_id' => $section->id ] );
		$badUser = factory( User::class )->create();

		$this->actingAs( $badUser )
		     ->put( "/theme/$section->theme_id/sections/$section->id/fields/$field->id", [
			     "label" => "Updated",
		     ] )->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid ID" ] );

		$this->assertNotEquals( "Updated", $field->fresh()->label );
	}

	/** @test */
	function it_can_be_destroyed() {
		$owner = factory(User::class)->create();
		$theme = factory(Theme::class)->create(['user_id' => $owner->id]);
		$section = factory( Section::class )->create(['theme_id' => $theme->id]);
		$field   = factory( CustomizerField::class )->create( [ 'section_id' => $section->id ] );

		$this->delete( "/theme/$section->theme_id/sections/$section->id/fields/$field->id" )
		     ->assertStatus( 302 );

		$this->actingAs($owner)->delete( "/theme/$section->theme_id/sections/$section->id/fields/$field->id" )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => true ] );


		$this->assertNull( $field->fresh() );
	}

	/** @test */
	function it_only_deletes_with_correct_theme_and_section_ids() {
		$owner = factory(User::class)->create();
		$theme = factory(Theme::class)->create(['user_id' => $owner->id]);
		$section = factory( Section::class )->create(['theme_id' => $theme->id]);
		$field   = factory( CustomizerField::class )->create( [ 'section_id' => $section->id ] );

		$badThemeId   = $section->theme_id + 1;
		$badSectionId = $section->id + 1;

		$this->delete( "/theme/$section->theme_id/sections/$badSectionId/fields/$field->id" )
		     ->assertStatus( 302 );

		$this->actingAs($owner)->delete( "/theme/$section->theme_id/sections/$badSectionId/fields/$field->id" )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid ID" ] );

		$this->assertNotNull( $field->fresh() );

		$this->delete( "/theme/$badThemeId/sections/$section->id/fields/$field->id" )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid ID" ] );

		$this->assertNotNull( $field->fresh() );
	}

	/** @test */
	function it_requires_a_matching_userid_if_not_anonymous_to_delete() {
		$user    = factory( User::class )->create();
		$theme   = factory( Theme::class )->create( [ "user_id" => $user->id ] );
		$section = factory( Section::class )->create( [ "theme_id" => $theme->id ] );
		$field   = factory( CustomizerField::class )->create( [ 'section_id' => $section->id ] );
		$badUser = factory( User::class )->create();

		$this->actingAs( $badUser )
		     ->delete( "/theme/$section->theme_id/sections/$section->id/fields/$field->id" )
		     ->assertStatus( 200 )
		     ->assertJson( [ "success" => false, "message" => "Invalid ID" ] );

		$this->assertNotNull( $field->fresh() );
	}

	/** @test */
	function it_can_get_the_stub_filename_for_the_given_field_type() {
		$fieldType = FieldType::where( 'name', 'Text Input' )->first();
		$field     = factory( CustomizerField::class )->create(['type_id' => $fieldType->id]);

		$this->assertEquals($fieldType->stub, $field->type->stub);
	}
}
