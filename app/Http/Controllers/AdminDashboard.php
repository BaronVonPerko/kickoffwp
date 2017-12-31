<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    public function __invoke() {
		return view('admin.dashboard');
    }
}
