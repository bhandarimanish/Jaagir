<style>
  .banner_image {
    background-image: url('/external/images/vacancy.jpg');
    height: 70%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
  }
</style>
@extends('layouts.main')
@section('content')
<div class="banner_image">
  <div class="content">
    <h4 style="color: white;"><a href="/"> Home </a>/Job Details</h4>
  </div>
</div>

<div class="album text-muted">
  <div class="container mt-4">
    @if(Session::has('message'))

    <div class="alert alert-success">{{Session::get('message')}}</div>
    @endif
    @if(Session::has('err_message'))

    <div class="alert alert-danger">{{Session::get('err_message')}}</div>
    @endif
    @if(isset($errors)&&count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <div class="row" id="app">
      <div class="col-md-12 mt-5 mx-auto text-center mb-5 section-heading">
        <h2 style="font-family: cursive;">{{Illuminate\Support\Str::limit($job->title,70)}}</h2>
      </div>

      <div class="col-lg-8 mt-3 bg-white">
        <div class="p-4 mb-8 bg-light">
          <!-- icon-book mr-3-->
          <h3 class="h5 text-black mb-3"><i class="fa fa-book" style="color: blue;">&nbsp;</i>Description: <a href="#" data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-envelope-square" style="font-size: 40px;float:right;color:green;"></i></a></h3>
          <p> {!!$job->description!!}</p>
          <hr>
        </div>
        <div class="p-4 mb-8 bg-light">
          <!--icon-align-left mr-3-->
          <h3 class="h5 text-black mb-3"><i class="fa fa-user" style="color: blue;">&nbsp;</i>Roles and Responsibilities:</h3>
          <p>{!!$job->roles!!}</p>
          <hr>
        </div>
        <div class="p-4 mb-8 bg-light">
          <h3 class="h5 text-black mb-3"><i class="fa fa-users" style="color: blue;">&nbsp;</i>Number of vacancy:</h3>
          <p>{{$job->number_of_vacancy }} .</p>
          <hr>
        </div>
        <div class="p-4 mb-8 bg-light">
          <h3 class="h5 text-black mb-3"><i class="fa fa-clock-o" style="color: blue;">&nbsp;</i>Experience:</h3>
          <p>{{$job->experience}}&nbsp;years</p>
          <hr>
        </div>
        <div class="p-4 mb-8 bg-light">
          <h3 class="h5 text-black mb-3"><i class="fa fa-venus-mars" style="color: blue;">&nbsp;</i>Gender:</h3>
          <p>{{$job->gender}} </p>
          <hr>
        </div>
        <div class="p-4 mb-8 bg-light">
          <h3 class="h5 text-black mb-3"><i class="fa fa-user" style="color: blue;">&nbsp;</i>Resources:</h3>
          @if(!$job->resources==NULL)
          <p>{!!$job->resources!!}</p>
          @else
          <p>No any resources!!</p>
          @endif
          <hr>
        </div>
        <div class="p-4 mb-8 bg-light">
          <h3 class="h5 text-black mb-3"><i class="fa fa-dollar" style="color: blue;">&nbsp;</i>Salary(RS):</h3>
          <p>{{$job->salary}}</p>
          <hr>
        </div>
      </div>


      <div class="col-md-4 p-4 site-section bg-light mt-3">
        <h3 class="text-black mb-3 text-center">Short Info</h3>
        <hr>
        <p><strong> Name:</strong>{{$job->company->cname}}</p>
        <p><strong>Address:</strong>{{$job->address}}</p>
        <p><strong>Employment Type:</strong>{{$job->type}}</p>
        <p><strong>Position:</strong>{{$job->position}}</p>
        <p><strong>Posted:</strong>{{$job->created_at->diffForHumans()}}</p>
        <p><strong>Last date to apply:</strong>{{ date('F d, Y', strtotime($job->last_date)) }}</p>



        <p><a href="{{route('company.index',[$job->company->id,$job->company->slug])}}" class="btn btn-warning" style="width: 100%;">Visit Company Page</a></p>
        <p>

          @if(Auth::check()&&Auth::user()->user_type=='seeker'&& $job->last_date < Carbon\Carbon::now()) <button class="btn btn-danger" style="width: 100%;" disabled>Apply the job</button>
            <p style="color: red; font-weight:600;text-align:center">The job has been expired.</p>
            @elseif(Auth::check()&&Auth::user()->user_type=='seeker'&&!Auth::user()->profile->address)
            <a class="btn btn-primary" style="width: 100%;"  href="{{route('user.profile')}}">Update the profile</a>
            <p style="color: red; font-weight:600;text-align:center">To apply, Please update your profile first.</p>
            @elseif(Auth::check()&&Auth::user()->user_type=='seeker'&&!Auth::user()->profile->resume)
            <a class="btn btn-primary" style="width: 100%;"  href="{{route('user.profile')}}">Update the resume</a>
            <p style="color: red; font-weight:600;text-align:center">To apply, Please update your resume.</p>
            @elseif(Auth::check()&&Auth::user()->user_type=='seeker'&&!Auth::user()->profile->cover_letter)
            <a class="btn btn-primary" style="width: 100%;"  href="{{route('user.profile')}}">Update the coverletter</a>
            <p style="color: red; font-weight:600;text-align:center">To apply, Please update your coverletter.</p>
            @elseif(Auth::check()&&Auth::user()->user_type=='seeker'&&Auth::user()->email_verified_at)

            @if(!$job->checkApplication())

            <apply-component :jobid={{$job->id}}></apply-component>
            @else
            <center><button class="btn btn-success mb-3" style="width: 100%;" disabled >You already applied for this job!!</button></center>
            @endif

            @elseif(Auth::check()&&Auth::user()->user_type=='seeker'&&!Auth::user()->email_verified_at)
            <a class="btn btn-primary" style="width: 100%;"  href="/email/verify">Email Verification</a>
            <p style="color: red; font-weight:600;text-align:center">Please verify your email to apply!</p>
            @elseif(Auth::check()&&Auth::user()->user_type=='employer')
            <p>You are employer and cant apply the job!</p>
            @elseif(Auth::check()&&Auth::user()->user_type=='admin')
            <p>You are admin and cant apply the job!</p>
            @else
            <p><a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary text-white" style="width: 100%;">Login</a></p>
            <p style="color: red; font-weight:600;text-align:center">Please login to apply for this job</p>
            @endif
            @if(Auth::check()&&Auth::user()->user_type=='seeker')
            <favorite-component :jobid={{$job->id}} :favorited={{$job->checkSaved()?'true':'false'}}></favorite-component>
            @endif
        </p>
      </div>
    </div>
  </div>
</div>


<div class="col-md-6 mt-4 mx-auto text-center mb-5 section-heading">
  <h2 style="font-family: cursive;">Recommended Jobs</h2>
</div>
<div class="container">
  <div class="row">
    @if(count($jobRecommendations)>0)
    @foreach($jobRecommendations as $jobRecommendation)
    <div class="col-sm-6 col-md-4 col-lg-3 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="100">
      <div class="card feature-item">
        <div class="badge badge-warning">{{$jobRecommendation->type}}</div>
        <h4 class="card-title mt-2">{{Illuminate\Support\Str::limit($jobRecommendation->company->cname,14)}}</h4>
        <p class="card-text font-weight-bold">{{Illuminate\Support\Str::limit($jobRecommendation->position,20)}}</p>
        @if ($jobRecommendation->last_date < Carbon\Carbon::now()) <p class="badge badge-danger">expired</p>
          @endif
          <center> <a href="{{route('jobs.show',[$jobRecommendation->id,$jobRecommendation->slug])}}" class="btn btn-success">Apply</a></center>
      </div>
    </div>
    @endforeach
  </div>
</div>
@else
<p class="col-md-6 mt-4 mx-auto text-center mb-5 section-heading" style="color: red;">Sorry, No Recommended Jobs Found!!</p>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send job to your friend</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('mail')}}" method="POST">@csrf

        <div class="modal-body">
          <input type="hidden" name="job_id" value="{{$job->id}}">
          <input type="hidden" name="job_slug" value="{{$job->slug}}">

          <div class="form-goup">
            <label>Your name * </label>
            <input type="text" name="your_name" class="form-control" required="" value="{{Auth::check()&&Auth::user()->name}}">
          </div>
          <div class="form-goup">
            <label>Your email *</label>
            <input type="email" name="your_email" class="form-control" required="" value="{{Auth::check()&&Auth::user()->email}}">
          </div>
          <div class="form-goup">
            <label>Person name *</label>
            <input type="text" name="friend_name" class="form-control" required="">
          </div>
          <div class="form-goup">
            <label>Person email *</label>
            <input type="email" name="friend_email" class="form-control" required="">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Mail this job</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


<br>
<br>
<br>

</div>
</div>
@endsection