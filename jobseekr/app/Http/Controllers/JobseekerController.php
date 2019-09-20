<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobseekerController extends Controller
{
    //
    public function showAuthForm(){ //fix
        return view('jobseeker/auth');
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

    public function logout(){ //maybe
        Session::flush();
        return redirect('welcome');
    }

    public function showDashboard(){ //fix
        $path = Storage::disk('public')->get('dashboard-jobseeker.json');
        $data = json_decode($path,true);
        return view('jobseeker/dashboard',compact('data'));
    }

    public function showApplicationForm(){ //fix
        return view('jobseeker/apply-job');
    }

    public function updateProfile($data){ //not yet
        //search data di json
        //diubah
        return view('jobseeker/profile');
    }

    public function updateSummary($data){ //not yet
        //search data di json
        //diubah
        return view('jobseeker/profile');
    }

    public function applyJob(){ //not yet | lanjutan showApplicationForm
        //isi data applyjob
        //disave
        //return view after apply job
    }

    public function showProfileForm(){ //fix
        return view('jobseeker/profile');
    }

    public function showApplication(){ //not yet
        //ngambil data application
        //return view application
    }
}
