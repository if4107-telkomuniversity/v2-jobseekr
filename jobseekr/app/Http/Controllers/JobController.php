<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;    

class JobController extends Controller
{
    //
    public function search($find){ //not yet
        $path = Storage::disk('public')->get('job-detail-jobseeker.json');
        $json = json_decode($path,true);
        $data = '123'; // disini ada cari job dulu
        return view('jobseeker/dashboard',compact('data'));
    }

    public function updateWorkExperience($data){ //not yet | lanjutan showProfileForm
        //ada pengubahan data terus disimpen
    }

    public function updateDocument($data){ //not yet | lanjutan showProfileForm
        //ada pengubahan data terus disimpen
    }

    public function showJobDetail(){
        $path = Storage::disk('public')->get('job-detail-jobseeker.json');
        $json = json_decode($path,true);
        return view('jobseeker/job-detail',compact('json'));
    }
}
