<?php

namespace Tests\Feature;

use App\Mail\WelcomeEmailSignupAlert;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WelcomeEmailTest extends TestCase
{
	use DatabaseTransactions;

	/** @test */
    public function it_can_submit_an_email_address()
    {
    	Mail::fake();

		$this->post('/remindme', [
			'email' => "thisisatest@testingemail.com"
		])->assertStatus(200);

		Mail::assertSent(WelcomeEmailSignupAlert::class, function ($mail) {
			return $mail->email == "thisisatest@testingemail.com";
		});
    }
}
