<?php

namespace App\Jobs;

use App\Theme;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class NightlyReport implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
        $newThemeCount = Theme::withTrashed()->whereDate('created_at', date('Y-m-d'))->count();
        $newUserCount = User::whereDate('created_at', date('Y-m-d'))->count();

        if($newThemeCount == 0 && $newUserCount == 0) return;

		Mail::to( env( 'MAIL_TO_ADDRESS', 'chris@chrisperko.net' ) )
			->send(new \App\Mail\NightlyReport($newThemeCount, $newUserCount));
    }
}
