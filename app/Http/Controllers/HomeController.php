<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Job $job)
    {
        if (Auth::user()->user_type == 'employer') {
            return redirect()->to('/company/create');
        }
        $adminrole = Auth::user()->roles()->pluck('name');
        if ($adminrole->contains('admin')) {
            return redirect()->to('/dashboard');
        }
        $jobs = Auth::user()->favorites;
        $user = Auth::user();
        $jobRecommendations = $this->jobRecommendations($job);
        return view('home', compact('jobs', 'jobRecommendations'));
    }

    public function jobRecommendations($job)
    {
        $data = [];
        $user = Auth::user();

        $jobBasedOnPosition = Job::where('position', 'LIKE', '%' . $user->profile->position . '%')
        ->where('id', '!=', $job->id)
        ->where('status', 1)
        ->inRandomOrder()
        ->limit(10)
        ->get();
    array_push($data, $jobBasedOnPosition);


        $jobsBasedOnCategories = Job::latest()->where('category_id', $user->profile->category)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(10)
            ->get();
        array_push($data, $jobsBasedOnCategories);


        $jobBasedOnType = Job::latest()
            ->where('type', $user->profile->jobtype)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->inRandomOrder()
            ->where('status', 1)
            ->limit(10)
            ->get();
        array_push($data, $jobBasedOnType);

        $jobBasedOnExperience = Job::latest()
            ->where('experience', $user->profile->experience)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->inRandomOrder()
            ->where('status', 1)
            ->limit(10)
            ->get();
        array_push($data, $jobBasedOnExperience);
        $collection  = collect($data);
        $collection =  $collection->unique("id");
        $jobRecommendations =  $collection->values()->first();
        return $jobRecommendations;
    }

    public function usermyjob()
    {
        $jobs = Auth::user()->userjob;
        return view('jobs.usermyjob', compact('jobs'));
    }
}
