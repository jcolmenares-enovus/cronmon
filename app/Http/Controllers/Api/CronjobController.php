<?php

namespace App\Http\Controllers\Api;

use App\Team;
use App\User;
use App\Cronjob;
use Illuminate\Http\Request;
use App\Rules\ValidCronExpression;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\UnauthorizedException;

class CronjobController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		$cronjobs = $user->getAvailableJobs();
		return response()->json([
			'count' => $cronjobs->count(), 
			'data' => $cronjobs,
		]);
	}


	public function show($uuid)
	{
		$user = Auth::user();
		$job = Cronjob::where('uuid', '=', $uuid)->firstOrFail();

		if ($user->id != $job->user_id) {
			throw new UnauthorizedException('The Cronjob do not belongs to current user');
		}

		return response()->json([
				'count' => 1,
				'data' => $job->toArray(),
			]);
	}

	public function update(Request $request)
	{
		$request->validate([
			'api_key' => 'required',
			'schedule' => ['required_without_all:period,period_units', new ValidCronExpression],
			'name' => 'required',
			'team' => 'nullable|string|exists:teams,name',
			'grace' => 'nullable|numeric',
			'grace_units' => 'nullable|in:minute,hour,day,week',
			'period' => 'required_without:schedule|numeric',
			'period_units' => 'required_without:schedule|in:minute,hour,day,week',
		]);

		$user = User::where('api_key', '=', $request->api_key)->firstOrFail();
		$team = false;
		if ($request->filled('team')) {
			$team = $user->teams()->where('name', '=', $request->team)->firstOrFail();
		}

		$job = Cronjob::where('name', '=', $request->name)->first();
		if (! $job) {
			$job = $user->addNewJob([
				'cron_schedule' => $request->schedule,
				'name' => $request->name,
				'team_id' => $team ? $team->id : -1,
				'grace' => $request->grace ?? 1,
				'grace_units' => $request->grace_units ?? 'hour',
				'period' => $request->period ?? 1,
				'period_units' => $request->period_units ?? 'hour',
			]);
		} else {
			$job = $job->updateFromForm([
				'cron_schedule' => $request->schedule,
				'team_id' => $team ? $team->id : $job->team_id,
				'grace' => $request->grace ?? 1,
				'grace_units' => $request->grace_units ?? 'hour',
				'period' => $request->period ?? 1,
				'period_units' => $request->period_units ?? 'hour',
			]);
		}

		return response()->json([
			'job' => $job->toArray(),
		]);
	}
}
