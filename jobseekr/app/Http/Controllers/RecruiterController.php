<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    //
    public function showAuthForm(){ //fixed
        return view('recruiter/auth');
    }

    public function login(Request $request){ //not yet
        $email = $request->email;
        $password = $request->password;

        $data = ModelUser::where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect('home_user');
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah !');
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }

    public function register(Request $request){ //not yet
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data =  new ModelUser();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('login')->with('alert-success','Kamu berhasil Register');
    }

    public function logout(){ //not yet
        Session::flush();
        return redirect('welcome');
    }

    public function showDashboard(){ //fixed
        $data = storage_path('mockdata.json');
        return view('recruiter/dashboard',compact('data'));
    }

    public function searchJob($search){ //not yet
        $data = storage_path('mockdata.json'); //ubah data dulu
        return view('recruiter/dashboard',compact('data'));
    }

    /*public function showCompanyProfile(){

    }

    public function editCompanyProfile(){

    } 

    public function editSummaryCompany(){

    }

    public function showJobDetails(){

    }*/

    public function showJobseekerSummary(){ //fixed
        $data = storage_path('mockdata.json');
        return view('recruiter/applicant-summary',compact('data'));
    }

    public function showJobseekerDetails(){ //fixed
        $data = storage_path('mockdata.json');
        return view('recruiter/application-detail',compact('data'));
    }

    public function acceptJobseeker(){ //not yet
        $data = storage_path('mockdata.json');
        return view('recruiter/application-respond',compact('data'));
    }

    public function declineJobseeker(){ //not yet
        $data = storage_path('mockdata.json');
        return view('recruiter/application-respond',compact('data'));
    }
}
