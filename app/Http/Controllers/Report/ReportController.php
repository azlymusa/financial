<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\SavingLogs;
use App\User;
use Carbon\Carbon;

class ReportController extends Controller {

	public function index () {

        $user = User::with('userDetails')->find(auth()->user()->id);

        $logIn = SavingLogs::where('status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('user_id', auth()->user()->id)
            ->sum('log_rm');

        $logOut = SavingLogs::where('status', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('user_id', auth()->user()->id)
            ->sum('log_rm');
        return view('private_content.report', compact('user', 'logIn', 'logOut'));
	}
}
