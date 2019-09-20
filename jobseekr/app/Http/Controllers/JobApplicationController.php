<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    //
    public function showJobseekerDetail(){
        $path = Storage::disk('public')->get('application-detail-recruiter.json');
        $json = json_decode($path,true);
        return('recruiter/application-detail',compact('json'));
    }

    public function comfirmationJobseeker(){
        $path = Storage::disk('public')->get('application-respond-recruiter.json');
        $json = json_decode($path,true);
        return view('recruiter/application-respond',compact('json'));
    }
}