<?php

use App\Company;
use App\Cv;
use App\Job;
use App\JobApplication;
use App\JobCategory;
use App\Jobseeker;
use App\Recruiter;
use App\Resume;
use App\SubmittedExperience;
use App\User;
use App\WorkExperience;
use Carbon\Carbon;
use App\Http\Transformers\SubmittedExperienceTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

if (!function_exists('newBasicUser')) {
    function newBasicUser($request, $type)
    {
        return User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $type,
        ]);
    }
}

if (!function_exists('newBasicJobseeker')) {
    function newBasicJobseeker($request, $userId)
    {
        return Jobseeker::create([
            'user_id' => $userId,
        ]);
    }
}

if (!function_exists('newBasicRecruiter')) {
    function newBasicRecruiter($request, $userId)
    {
        return Recruiter::create([
            'user_id'    => $userId,
            'company_id' => $request->company,
        ]);
    }
}

if (!function_exists('registerUser')) {
    function registerUser($request, $type)
    {
        $user = newBasicUser($request, $type);
        if ($type == 'jobseeker') {
            newBasicJobseeker($request, $user->id);
            return $user;
        }
        newBasicRecruiter($request, $user->id);
        return $user;
    }
}

if (!function_exists('indexCompany')) {
    function indexCompany()
    {
        $companies = Company::where('is_deleted', false)->with('industry')->get();
        return $companies;
    }
}

if (!function_exists('authUser')) {
    function authUser($request, $role)
    {
        try {
            $user = User::where('email', $request->email)->where('role', $role)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
        if (!Hash::check($request->password, $user->password)) {
            return null;
        }
        return $user;
    }
}

if (!function_exists('indexJob')) {
    function indexJob($options = [])
    {
        $withCompany        = $options['withCompany'] ?? false;
        $withApplicant      = $options['withApplicant'] ?? false;
        $includeExpiredJobs = $options['includeExpiredJobs'] ?? false;
        $internalOnly       = $options['internalOnly'] ?? false;

        $job = Job::orderBy('created_at', 'desc');
        if (!$includeExpiredJobs) {
            $job = $job->where('expired_at', '>=', date('Y-m-d'));
        }
        if ($internalOnly) {
            $companyId = Recruiter::where('user_id', Auth::id())->first()->company_id;
            $job       = $job->where('company_id', $companyId);
        }
        if ($withCompany) {
            $job = $job->with('company');
        }
        if ($withApplicant) {
            $job = $job->withCount('applicants');
        }
        return $job->paginate(8);
    }
}

if (!function_exists('newJob')) {
    function newJob($request)
    {
        $companyId = Recruiter::where('user_id', Auth::id())->first()->company_id;
        return Job::create([
            'position'      => $request->position,
            'summary'       => $request->summary,
            'type'          => $request->type,
            'min_education' => $request->min_education,
            'expired_at'    => $request->expired_at,
            'salary'        => $request->salary,
            'company_id'    => $companyId,
            'category_id'   => $request->category,
        ]);
    }
}

if (!function_exists('indexJobCategory')) {
    function indexJobCategory()
    {
        return JobCategory::where('is_deleted', false)->get();
    }
}

if (!function_exists('searchJobFromDB')) {
    function searchJobFromDB($query, $options = [])
    {
        $internalOnly       = $options['internalOnly'] ?? false;
        $withApplicant      = $options['withApplicant'] ?? false;
        $includeExpiredJobs = $options['includeExpiredJobs'] ?? false;

        $jobs = Job::where('position', 'like', "%$query%")->orderBy('created_at', 'desc');
        if ($internalOnly) {
            $companyId = Recruiter::where('user_id', Auth::id())
                ->first()->company_id;
            $jobs->where('company_id', $companyId);
        } else {
            $jobs = $jobs->orWhereHas('company', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            });
            $jobs = $jobs->with('company');
        }
        if ($withApplicant) {
            $jobs = $jobs->withCount('applicants');
        }
        if (!$includeExpiredJobs) {
            $jobs = $jobs->whereDate('expired_at', '>=', date('Y-m-d'));
        }
        return $jobs->get();
    }
}

if (!function_exists('showJob')) {
    function showJob($id, $internalOnly=false)
    {
        $job = Job::where('id', $id);
        if ($internalOnly) {
            $companyId = Recruiter::where('user_id', Auth::id())->first()->company_id;
            $job       = $job->where('company_id', $companyId);
        } else {
            $job = $job->with('company');
        }
        return $job->firstOrFail();
    }
}

if (!function_exists('getLoggedinUser')) {
    function getLoggedinUser()
    {
        $user = Auth::user();
        return $user;
    }
}

if (!function_exists('getUserDetail')) {
    function getUserDetail($userId, $role)
    {
        switch ($role) {
            case 'jobseeker':
                return Jobseeker::where('user_id', $userId)->first();
            case 'recruiter':
                return Recruiter::where('user_id', $userId)->first();
        }
    }
}

if (!function_exists('getWorkExperience')) {
    function getWorkExperience($userId)
    {
        return WorkExperience::where('user_id', $userId)->get();
    }
}


if (!function_exists('addWorkExperience')) {
    function addWorkExperience($request, $options=[])
    {
        $user = $options['user'] ?? Auth::user();
        $workExperience = WorkExperience::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'position' => $request->position,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ]);
        return $workExperience;
    }
}

if (!function_exists('validateExperiences')) {
    function validateExperiences($experienceIds, $options = [])
    {
        $user = $options['user'] ?? Auth::user();
        return count($experienceIds) == WorkExperience::
            whereIn('id', $experienceIds)->where('user_id', $user->id)
            ->count();
    }
}

if (!function_exists('validateJob')) {
    function validateJob($id, $options = [])
    {
        $user = $options['user'] ?? Auth::user();
        return Job::where('id', $id)->where('expired_at', '>=', now())->exists();
    }
}

if (!function_exists('saveCv')) {
    function saveCv($file, $jobId, $options = [])
    {
        $user = $options['user'] ?? Auth::user();
        
        $fileName = sprintf('%s_%s_%s.%s', 
            $user->id,
            $jobId,
            date('Y-m-d_h-i-s'),
            $file->getClientOriginalExtension());
        $cv = Cv::create([
            'user_id' => $user->id,
            'title' => $file->getClientOriginalName(),
            'file_name' => $fileName
        ]);
        $file->storeAs($cv->path, $fileName);
        return $cv;
    }
}

if (!function_exists('arrStringToArr')) {
    function arrStringToArr($arrString)
    {
        $str = substr($arrString, 1, strlen($arrString) - 2);
        return explode(',', $str);
    }
}

if (!function_exists('saveResume')) {
    function saveResume($file, $jobId, $options = [])
    {
        $user = $options['user'] ?? Auth::user();
        
        $fileName = sprintf('%s_%s_%s.%s', 
            $user->id,
            $jobId,
            date('Y-m-d_h-i-s'),
            $file->getClientOriginalExtension());
        $resume = Resume::create([
            'user_id' => $user->id,
            'title' => $file->getClientOriginalName(),
            'file_name' => $fileName
        ]);
        $file->storeAs($resume->path, $fileName);
        return $resume;
    }
}

if (!function_exists('submitApplication')) {
    function submitApplication($jobId, $request, $options)
    {
        $user = $options['user'] ?? Auth::user();

        $cv = saveCv($request->file('cv'), $jobId, $options);
        $resume = saveResume($request->file('resume'), $jobId, $options);
        $experienceIds = arrStringToArr($request->experiences);

        $jobApplication = JobApplication::create([
            'user_id' => $user->id,
            'job_id' => $jobId,
            'summary' => $request->summary,
            'cv_id' => $cv->id,
            'resume_id' => $resume->id
        ]);
        
        $submittedExperiencesArr = SubmittedExperienceTransformer::prepareBulkInsertion(
            $experienceIds,
            $jobApplication->id
        );
        $submittedExperiences = SubmittedExperience::insert($submittedExperiencesArr);

        return $jobApplication;
    }
}

if (!function_exists('getJobApplication')) {
    function getJobApplication($id)
    {
        return JobApplication::findOrFail($id);
    }
}

if (!function_exists('validateJobApplication')) {
    function validateJobApplication($recruiter, $jobApplication)
    {
        return $recruiter->company_id == $jobApplication->job->company_id;
    }
}

if (!function_exists('confirmJobApplication')) {
    function confirmJobApplication($jobApplication, $isAccepted)
    {
        $jobApplication->is_accepted = boolval($isAccepted);
        $jobApplication->save();
        return $jobApplication;
    }
}

if (!function_exists('indexApplicant')) {
    function indexApplicant($jobId)
    {
        return JobApplication::where('job_id', $jobId)->where('is_accepted', null)->with('user')->paginate(8);
    }
}

if (!function_exists('getApplication')) {
    function getApplication($id)
    {
        return JobApplication::where('id', $id)->with('user')
            ->with('user.jobseeker')
            ->with('experiences')
            ->with('experiences.object')
            ->with('cv')
            ->with('resume')
            ->firstOrFail();
    }
}
