<?php

namespace Tests\Feature;

use App\WelcomeEmailAddress;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageEmailSignupTest extends TestCase {
	use RefreshDatabase;

	/** @test */
	public function it_can_register_an_email_address() {
		$this->post( '/remindme', [ 'email' => 'testemail@test.com' ] );

		$count = WelcomeEmailAddress::where( 'email', 'testemail@test.com' )->count();

		$this->assertEquals( 1, $count );
	}

	/** @test */
	public function it_will_not_create_duplicates() {
		$this->post( '/remindme', [ 'email' => 'testemail@test.com' ] );
		$this->post( '/remindme', [ 'email' => 'testemail@test.com' ] );

		$count = WelcomeEmailAddress::where( 'email', 'testemail@test.com' )->count();

		$this->assertEquals( 1, $count );
	}
}
