<?php

namespace Tests\Feature;

use Auth;
use App\Company;
use App\Job;
use App\Recruiter;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;

class JobTest extends TestCase
{
	public function testCreateJob()
	{
		$this->login();

		$data = [
			'position' => 'Software Engineer In Test',
        	'summary' => 'Your job is to implement testing in Telkom University\'s various services.',
        	'type' => 'full_time',
	    	'min_education' => 'bachelor',
	    	'expired_at' => '2019-12-31',
	    	'salary' => '10000000',
	    	'category' => '1',
	    	'_token' => csrf_token()
		];
		$result = $this->call('POST', '/recruiter/job/new', $data);
		$this->assertTrue(! $result->getSession()->has('errors'));

		$data = [
			'position' => 'Software Engineer In Test',
        	'summary' => 'Your job is to implement testing in Telkom University\'s various services.',
        	'type' => 'full_time',
	    	'min_education' => 'bachelor',
	    	'expired_at' => '2019-12-31',
	    	'salary' => '-1',
	    	'category' => '1',
	    	'_token' => csrf_token()
		];
		$result = $this->call('POST', '/recruiter/job/new', $data);
		$this->assertTrue($result->getSession()->has('errors'));

		$this->logout();
	}

	protected function login()
	{
		$request = new Request();
		$request->setMethod('POST');
		$request->request->add([
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18'
		]);
		$user = authUser($request, 'recruiter');
		Auth::login($user);
	}

	protected function logout()
	{
		Auth::logout();
	}
}