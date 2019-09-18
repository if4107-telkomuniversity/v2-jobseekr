<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    //
    public function editWorkExp(){ //lanjutan showProfileForm
        //ada pengubahan data terus disimpen
    }

    public function editDocument(){ //lanjutan showProfileForm
        //ada pengubahan data terus disimpen
    }

    public function showJobProfile(){
        return view('jobseeker/job-detail');
    }
}
