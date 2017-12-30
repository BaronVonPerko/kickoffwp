<?php

namespace Tests\Feature;

use App\WelcomeEmailAddress;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeEmailTest extends TestCase
{
	use DatabaseTransactions;

    /** @test */
    function it_can_be_marked_as_sent()
    {
		$email = factory(WelcomeEmailAddress::class)->create();

		$this->assertEquals(0, $email->fresh()->is_sent);

		$email->markSent();

		$this->assertEquals(1, $email->fresh()->is_sent);
    }
}
