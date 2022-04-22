<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Job;
use App\Company;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Testimonial;
use App\User;
use Mail;
use DB;
use App\Mail\JobStatus;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware(['employer', 'verified'], ['except' => array('index', 'show', 'apply', 'allJobs', 'searchJobs', 'internship', 'allinternship')]);
    }

    public function index()
    {
        $jobs = Job::latest()->whereDate('last_date', '>', date('Y-m-d'))->limit(5)->where('status', 1)->get();
        $companies = Company::get()->random(8);
        $categories = Category::with('jobs')->get();
        $posts = Post::where('status', 1)->get();
        $testimonial = Testimonial::orderBy('id', 'desc')->first();
        return view('welcome', compact('jobs', 'companies', 'categories', 'posts', 'testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applicants = Job::has('users')->get();
        foreach ($applicants as $applicant) {
            $count = \DB::table('job_user')->where('job_id', $applicant->id)->where('status', -1)->count();
        }
        return view('jobs.create', compact('count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'roles' => 'required',
            'address' => 'required',
            'position' => 'required',
            'last_date' => 'required',
            'number_of_vacancy' => 'required|numeric',
            'experience' => 'required|numeric',
        ]);
        $user_id = auth()->user()->id;
        $company = Company::where('user_id', $user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'description' => request('description'),
            'roles' => request('roles'),
            'category_id' => request('category'),
            'position' => request('position'),
            'address' => request('address'),
            'type' => request('type'),
            'status' => request('status'),
            'last_date' => request('last_date'),
            'number_of_vacancy' => request('number_of_vacancy'),
            'gender' => request('gender'),
            'experience' => request('experience'),
            'salary' => request('salary'),
            'resources' => request('resources')

        ]);
        return redirect()->back()->with('message', 'Job created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Job $job)
    {
        $data = [];

        $jobsBasedOnCategories = Job::latest()->where('category_id', $job->category_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(10)
            ->get();
        array_push($data, $jobsBasedOnCategories);

        $jobBasedOnCompany = Job::latest()
            ->where('company_id', $job->company_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(10)
            ->get();
        array_push($data, $jobBasedOnCompany);

        $jobBasedOnPosition = Job::where('position', 'LIKE', '%' . $job->position . '%')
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(10)
            ->get();
        array_push($data, $jobBasedOnPosition);
        $data  = collect($data);
        $jobRecommendations = $data->unique('id')->values()->first();
        return view('jobs.show', compact('job', 'jobRecommendations'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $job->update($request->all());
        return redirect()->route('job.mine')->with('message', "Job updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobs = Job::find($id);
        $jobs->delete();
        return redirect()->back()->with('messages', 'Job has been deleted successfully');
    }

    public function myjob()
    {
        $jobs = Job::where('user_id', auth()->user()->id)->get();
        return view('jobs.myjob', compact('jobs'));
    }

    public function apply(Request $request, $id)
    {
        $jobId = Job::find($id);
        $jobId->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message', 'Application sent!');
    }

    public function applicant()
    {

        $applicants = Job::has('users')->get();
        return view('jobs.applicants', compact('applicants'));
    }

    public function jobstatus(Request $request, $id)
    {
        $jobId = Job::find($id);
        $status = $request->status;
        $userid = $request->userid;
        $applicantId = User::find($userid);
        $companyname = $jobId->company->cname;
        $description = $request->description;
        $applicantname = $applicantId->name;
        $jobname = $jobId->name;
        $homeUrl = url('/');
        $jobSlug = $jobId->slug;
        $jobUrl = $homeUrl . '/' . 'jobs/' . $id . '/' . $jobSlug;
        $data = array(
            'company_name' => $companyname,
            'status' => $status,
            'description' => $description,
            'name' => $applicantname,
            'jobname' => $jobname,
            'jobUrl' => $jobUrl
        );

        $applicantemail = $applicantId->email;
        try {
            Mail::to($applicantemail)->send(new JobStatus($data));
            return redirect()->back()->with('message', 'Status changed and Mail sent to ' . $applicantemail);
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'Sorry, Something went wrong.Please try later');
        } finally {
            $jobId->users()->detach($userid);
            $jobId->users()->attach($userid, ['status' => $status, 'description' => $description]);
        }
    }

    public function applicantview($id)
    {
        $user = User::findorfail($id);
        return view('jobs.applicantsview', compact('user'));
    }

    public function allJobs(Request $request)
    {

        //front search
        $search = $request->get('search');
        $address = $request->get('address');
        if ($search && $address) {
            $jobs = Job::where('position', 'LIKE', '%' . $search . '%')
                ->orWhere('title', 'LIKE', '%' . $search . '%')
                ->orWhere('type', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $address . '%')
                ->paginate(20);

            return view('jobs.alljobs', compact('jobs'));
        }




        $keyword = $request->get('position');
        $type = $request->get('type');
        $category = $request->get('category_id');
        $address = $request->get('address');
        if ($keyword || $type || $category || $address) {
            $jobs = Job::where('position', 'LIKE', '%' . $keyword . '%')
                ->orWhere('type', $type)
                ->orWhere('category_id', $category)
                ->orWhere('address', $address)
                ->paginate(20);
            return view('jobs.alljobs', compact('jobs'));
        } else {

            $jobs = Job::latest()->where('type', 'fulltime')->orWhere('type', 'parttime')->paginate(20);
            return view('jobs.alljobs', compact('jobs'));
        }
    }
    public function searchJobs(Request $request)
    {

        $keyword = $request->get('keyword');
        $job = Job::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('position', 'like', '%' . $keyword . '%')
            ->limit(5)->get();
        return response()->json($job);
    }

    public function internship(Request $request)
    {
        $keyword = $request->get('position');
        $type = $request->get('type');
        $roles = $request->get('roles');
        $category = $request->get('category_id');
        $address = $request->get('address');
        if ($keyword || $type || $category || $address || $roles) {
            $internships = Job::where('position', 'LIKE', '%' . $keyword . '%')
                ->Where('type', $type)
                ->orWhere('category_id', $category)
                ->orWhere('address', $address)
                ->orWhere('roles', $roles)
                ->paginate(20);

            return view('jobs.internship', compact('internships'));
        } else {
            $numbers = Job::where('type', 'internship')->inRandomOrder()->pluck('id');
            $array_size = count($numbers);

            for ($i = 0; $i < $array_size; $i++) {
                for ($j = 0; $j < $array_size; $j++) {
                    if ($numbers[$i] < $numbers[$j]) {
                        $temp = $numbers[$i];
                        $numbers[$i] = $numbers[$j];
                        $numbers[$j] = $temp;
                    }
                }
            }
            function bubble_Sort($my_array)
            {
                do {
                    $swapped = false;
                    for ($i = 0, $c = count($my_array) - 1; $i < $c; $i++) {
                        if ($my_array[$i] > $my_array[$i + 1]) {
                            list($my_array[$i + 1], $my_array[$i]) =
                                array($my_array[$i], $my_array[$i + 1]);
                            $swapped = true;
                        }
                    }
                } while ($swapped);
                return $my_array;
            }
            $test_array = Job::where('type', 'internship')->pluck('id');
            $data = bubble_Sort($test_array);
            $internships = Job::whereIn('id', $data)->where('status', 1)->paginate(10);
            return view('jobs.internship', compact('internships'));
        }
    }
}
