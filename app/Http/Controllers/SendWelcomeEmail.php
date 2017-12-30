<?php

namespace App\Http\Controllers;

use App\Mail\LaunchEmail;
use App\WelcomeEmailAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail extends Controller
{
    public function __invoke() {
	    $addresses = WelcomeEmailAddress::NotSent()->get();

	    foreach($addresses as $address) {
		    Mail::to( $address->email )
		        ->send(new LaunchEmail());

		    $address->markSent();

		    echo 'Sent to ' . $address . '<br>';
	    }
    }
}
