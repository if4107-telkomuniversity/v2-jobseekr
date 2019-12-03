<?php

namespace Tests\Unit;

use Auth;
use App\Company;
use App\Job;
use App\Recruiter;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Tests\TestCase;

class JobTest extends TestCase
{
	public function testIndexJob()
	{
		$job = Job::orderBy('created_at', 'desc')->get();
		$this->assertEquals($job, indexJob());

		$this->indexAsJobseeker();
		$this->indexAsRecruiter();
	}

	protected function indexAsJobseeker()
	{
		$expected = Job::with('company')->orderBy('created_at', 'desc')->get();

		$request = new Request();
		$request->setMethod('POST');
		$request->request->add([
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18'
		]);
		$user = authUser($request, 'jobseeker');
		Auth::login($user);
		$options = ['withCompany' => true];
		$this->assertEquals($expected, indexJob($options));
		Auth::logout();
	}

	protected function indexAsRecruiter()
	{
		$request = new Request();
		$request->setMethod('POST');
		$request->request->add([
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18'
		]);
		$user = authUser($request, 'recruiter');
		Auth::login($user);

		$recruiter = Recruiter::where('user_id', $user->id)->first();
		$expected = Job::withCount('applicants')
			->where('company_id', $recruiter->company_id)
			->orderBy('created_at', 'desc')
			->get();

		$options = [
			'withApplicant' => true,
			'internalOnly' => true
		];
		$this->assertEquals($expected, indexJob($options));
		Auth::logout();
	}

	public function testShowJob()
	{
		$request = new Request();
		$request->setMethod('POST');
		$request->request->add([
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18'
		]);
		$user = authUser($request, 'jobseeker');
		Auth::login($user);
		$jobId = 1;
		$expected = Job::with('company')->find($jobId);
		$this->assertEquals($expected, showJob($jobId));

		$jobId = 10;
		try {
			showJob($jobId);
		} catch (ModelNotFoundException $e) {
			$this->assertTrue(true);
		}
		Auth::logout();
	}
}