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
        if(Auth::user()->user_type=='employer')
        {
            return redirect()->to('/company/create');
        }
        $adminrole=Auth::user()->roles()->pluck('name');
        if($adminrole->contains('admin'))
        {
            return redirect()->to('/dashboard');
        }
        $jobs=Auth::user()->favorites;
        $jobRecommendations = $this->jobRecommendations($job);
        return view('home',compact('jobs','jobRecommendations'));
    }

    public function jobRecommendations($job)
    {
        $data = [];

        $jobsBasedOnCategories = Job::latest()->where('category_id', $job->category_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6)
            ->get();
        array_push($data, $jobsBasedOnCategories);

        $jobBasedOnCompany = Job::latest()
            ->where('company_id', $job->company_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6)
            ->get();
        array_push($data, $jobBasedOnCompany);

        $jobBasedOnPosition = Job::where('position', 'LIKE', '%' . $job->position . '%')
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6);
        array_push($data, $jobBasedOnPosition);
        $collection  = collect($data);
        $unique = $collection->unique("id");
        $jobRecommendations =  $unique->values()->first();
        return $jobRecommendations;
    }

    public function usermyjob()
    {
        $jobs=Auth::user()->userjob;
        return view('jobs.usermyjob',compact('jobs'));
    }



}
