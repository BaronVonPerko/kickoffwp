<?php

namespace App\Mail;

use App\WelcomeEmailAddress;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NightlyReport extends Mailable {
	use Queueable, SerializesModels;

	protected $count, $emails;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->emails = WelcomeEmailAddress::SignedUpToday()->get();
		$this->count  = $this->emails->count();
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown( 'emails.nightlyReport', [
			'emails' => $this->emails,
			'count'  => $this->count,
		] );
	}
}
