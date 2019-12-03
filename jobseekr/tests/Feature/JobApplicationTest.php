<?php

namespace Tests\Feature;

use App\Job;
use App\JobApplication;
use App\Jobseeker;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JobApplicationTest extends TestCase
{
    protected function login()
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add([
            'email'    => 'vayu@vayu.id',
            'password' => 'iniVayu18',
        ]);
        $user = authUser($request, 'recruiter');
        Auth::login($user);
    }

    protected function loginAsJobseeker()
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add([
            'email'    => 'vayu@vayu.id',
            'password' => 'iniVayu18',
        ]);
        $user = authUser($request, 'jobseeker');
        Auth::login($user);
    }

    protected function logout()
    {
        Auth::logout();
    }

    public function testApplyJob()
    {
        $this->loginAsJobseeker();
        $data = [
            'summary'     => 'AKU ADALAH TELYUTIZEN YANG CINTA ALMAMATER EAAAAA',
            'experiences' => '[2,3]',
            'cv'          => new UploadedFile('/home/user/Downloads/ksm.pdf', 'ksm.pdf', 1024, 'pdf', null, true),
            'resume'      => new UploadedFile('/home/user/Downloads/ksm.pdf', 'ksm.pdf', 1024, 'pdf', null, true),
        ];

        $jobId = Job::where('company_id', 1)
        	->whereNotIn('id', JobApplication::pluck('job_id')->toArray())->first()->id;

        $result = $this->call('POST', "job/$jobId/apply", $data);
        $this->assertTrue(! $result->getSession()->has('errors'));
    }

    public function testConfirmApplication()
    {
        $this->login();

        $data = [
            'job_application_id' => JobApplication::first()->id,
            'is_accepted'        => true,
        ];

        $result = $this->call('POST', 'recruiter/applicant/confirm', $data);
        $this->assertTrue(!$result->getSession()->has('errors'));

        $data = [
            'job_application_id' => JobApplication::orderBy('id', 'desc')->first()->id + 1,
            'is_accepted'        => true,
            '_token'             => csrf_token(),
        ];
        $result = $this->call('POST', 'recruiter/applicant/confirm', $data);
        $this->assertTrue($result->getSession()->has('errors'));

        $this->logout();
    }
}
