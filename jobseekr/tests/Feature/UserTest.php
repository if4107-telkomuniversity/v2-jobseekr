<?php

namespace Tests\Feature;

use Auth;
use Illuminate\Support\Facades\Session;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	public function testJobseekerCanLogin()
	{
		// invalid password
		$result = $this->call('POST', 'auth/login', [
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18s',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// email not found
		$result = $this->call('POST', 'auth/login', [
			'email' => 'vayu@vayu.id2',
			'password' => 'iniVayu18',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// invalid email type
		$result = $this->call('POST', 'auth/login', [
			'email' => 'vayu',
			'password' => 'iniVayu18',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// invalid password type
		$result = $this->call('POST', 'auth/login', [
			'email' => 'vayu@vayu.id',
			'password' => '',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// success
		$result = $this->call('POST', 'auth/login', [
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18',
			'_token' => csrf_token()
		]);
		$this->assertTrue(! $result->getSession()->has('errors'));
	}

	public function testRecruiterCanLogin()
	{
		// invalid password
		$result = $this->call('POST', 'recruiter/auth/login', [
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18s',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// email not found
		$result = $this->call('POST', 'recruiter/auth/login', [
			'email' => 'vayu@vayu.id2',
			'password' => 'iniVayu18',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// invalid email type
		$result = $this->call('POST', 'recruiter/auth/login', [
			'email' => 'vayu',
			'password' => 'iniVayu18',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// invalid password type
		$result = $this->call('POST', 'recruiter/auth/login', [
			'email' => 'vayu@vayu.id',
			'password' => '',
			'_token' => csrf_token()
		]);
		$this->assertTrue($result->getSession()->has('errors'));

		// success
		$result = $this->call('POST', 'recruiter/auth/login', [
			'email' => 'vayu@vayu.id',
			'password' => 'iniVayu18',
			'_token' => csrf_token()
		]);
		$this->assertTrue(! $result->getSession()->has('errors'));
	}
}