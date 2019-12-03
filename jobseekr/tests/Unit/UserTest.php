<?php

namespace Tests\Unit;

use App\Company;
use App\Jobseeker;
use App\Recruiter;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $faker    = Faker::create();
        $roles    = ['jobseeker', 'recruiter'];
        $password = $faker->password;
        $requests = [];
        $data     = [];
        for ($i = 0; $i < random_int(3,5); $i++) {
            $newElem = [
                'name'                  => $faker->name,
                'email'                 => $faker->unique()->email,
                'password'              => $password,
                'password_confirmation' => $password,
            ];
            $request = new Request();
            $request->setMethod('POST');
            $request->request->add($newElem);
            array_push($data, $newElem);
            array_push($requests, $request);
        }

        $users = [];
        for ($i = 0; $i < count($data); $i++) {
            $role = $roles[array_rand($roles)];
            $user = newBasicUser($requests[$i], $role)->toArray();
            unset($data[$i]['password']);
            unset($data[$i]['password_confirmation']);
            $data[$i]['role']       = $role;
            $data[$i]['created_at'] = $user['created_at'];
            $data[$i]['updated_at'] = $user['updated_at'];
            $data[$i]['id']         = $user['id'];
            $this->assertEquals($data[$i], $user);
        }
    }

    public function testCreateJobseeker()
    {
        $role    = 'jobseeker';
        $userIds = User::where('role', $role)
            ->whereNotIn('id', Jobseeker::pluck('id')->toArray())
            ->pluck('id')->toArray();
        $jobseekers = [];
        for ($i = 0; $i < count($userIds); $i++) {
            $jobseeker = newBasicJobseeker(new Request(), $userIds[$i])->toArray();
            $data      = [
                'user_id' => $userIds[$i],
                'id'      => $jobseeker['id'],
            ];
            $this->assertEquals($data, $jobseeker);
        }
    }

    public function testCreateRecruiter()
    {
        $role    = 'recruiter';
        $userIds = User::where('role', $role)
            ->whereNotIn('id', Recruiter::pluck('id')->toArray())
            ->pluck('id')->toArray();
        $companyIds = Company::pluck('id')->toArray();
        $recruiter  = [];
        for ($i = 0; $i < count($userIds); $i++) {
            $companyId = $companyIds[array_rand($companyIds)];
            $request   = new Request();
            $request->setMethod('POST');
            $request->request->add(['company' => $companyId]);
            $jobseeker = newBasicRecruiter($request, $userIds[$i])->toArray();
            $data      = [
                'user_id'    => $userIds[$i],
                'id'         => $jobseeker['id'],
                'company_id' => $companyId,
            ];
            $this->assertEquals($data, $jobseeker);
        }
    }

    public function testLoginAsJobseeker()
    {
        $role = 'jobseeker';
        $data = [
            'email'    => 'vayu@vayu.id',
            'password' => 'iniVayu18',
        ];
        $expected = [
            'id'         => 1,
            'name'       => 'I Gusti Bagus Vayupranaditya Putraadinatha',
            'phone'      => null,
            'email'      => 'vayu@vayu.id',
            'role'       => 'jobseeker',
            'is_deleted' => 0,
            'created_at' => '2019-11-29 19:20:25',
            'updated_at' => '2019-11-29 19:20:25'
        ];
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add($data);
        $result = authUser($request, $role)->toArray();
        $this->assertEquals($expected, $result);

        $data = [
        	'email' => 'vayu@vayu.id',
        	'password' => 'wrongPassword'
        ];
        $expected = null;

        $request = new Request();
        $request->setMethod('POST');
        $request->request->add($data);
        $result = authUser($request, $role);
        $this->assertEquals($expected, $result);
    }

    public function testLoginAsRecruiter()
    {
        $role = 'recruiter';
        $data = [
            'email'    => 'vayu@vayu.id',
            'password' => 'iniVayu18',
        ];
        $expected = [
            'id'         => 10,
            'name'       => 'vayu',
            'phone'      => null,
            'email'      => 'vayu@vayu.id',
            'role'       => 'recruiter',
            'is_deleted' => 0,
            'created_at' => '2019-11-29 20:07:09',
            'updated_at' => '2019-11-29 20:07:09'
        ];
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add($data);
        $result = authUser($request, $role)->toArray();
        $this->assertEquals($expected, $result);

        $data = [
        	'email' => 'vayu@vayu.id',
        	'password' => 'wrongPassword'
        ];
        $expected = null;

        $request = new Request();
        $request->setMethod('POST');
        $request->request->add($data);
        $result = authUser($request, $role);
        $this->assertEquals($expected, $result);
    }
}
