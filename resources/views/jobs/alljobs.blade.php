<style>
  .banner_image {
    background-image: url('/external/images/alljob.jpg');
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
    <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Job Filter</h4>
  </div>
</div>
<div class="col-md-6 mt-4 mx-auto text-center mb-5 section-heading">
  <h2 style="font-family: cursive;">All Jobs</h2>
</div>
<div class="container mt-5">
  <div class="row">
    <form action="{{route('job.all')}}" method="GET">

      <div class="form-inline font-weight-bold">
        <div class="form-group  ">
          <label>Position:</label>
          <input type="text" name="position" class="form-control" placeholder="job position" required>
        </div>
        <div class="form-group">
          <label>Employment:</label>
          <select class="form-control" name="type">
            <option value="">-select-</option>
            <option value="fulltime">fulltime</option>
            <option value="parttime">parttime</option>
            <option value="internship">internship</option>
          </select>
        </div>
        <div class="form-group">
          <label>Category:</label>
          <select name="category_id" class="form-control">
            <option value="">-select-</option>

            @foreach(App\Category::all() as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Address:</label>
          <input type="text" name="address" class="form-control" placeholder="address">
        </div>

        <div class="form-group row d-flex justify-content-center align-content-center ml-1">
          <input type="submit" class="btn btn-search btn-warning btn-sm btn-block" value="Search">

        </div>
      </div> <br>

    </form>

    <div class="col-md-12">
      <div class="rounded border jobs-wrap" style="background-color: #f0edf5;">
        @if(count($jobs)>0)
        @foreach($jobs as $job)

        <a href="{{route('jobs.show',[$job->id,$job->slug])}}" class="job-item d-block d-md-flex align-items-center  border-bottom @if($job->type=='parttime') partime @elseif($job->type=='fulltime')fulltime @else internship   @endif;">
          <div class="company-logo blank-logo text-center pl-3">
            @if(!empty($job->company->logo))
            <img src="{{asset('companylogo')}}/{{$job->company->logo}}" alt="Image" height="50px"  style="border-radius: 50%;">
            @else
            <img src="{{asset('companylogo/logo.jpg')}}" alt="Image" style="border-radius: 50%;">
            @endif
          </div>
          <div class="job-details">
            <div class="p-3 align-self-center">
              <h3>{{$job->position}}</h3>
              <div class="d-block d-lg-flex">
                <div class="mr-3"><span class="icon-suitcase  font-weight-bold"></span> {{$job->company->cname}}</div>
                <div class="mr-3"><span class="icon-room font-weight-bold"></span> {{Str::limit($job->address,20)}}</div>
                <div class="mr-3"><span class="fa fa-money mr-1 font-weight-bold"></span>{{$job->salary}}</div>
                <div class="mr-3"><span class="fa fa-clock-o mr-1 font-weight-bold"></span>{{$job->created_at->diffForHumans()}}</div>
                @if ($job->last_date < Carbon\Carbon::now()) <div class="mr-3"><span class="fa fa-bell-slash-o mr-1 font-weight-bold"></span>
                  <p class="badge badge-danger">expired</p>
              </div>
              @endif
            </div>
          </div>
      </div>
      <div class="job-category align-self-center">
        @if($job->type=='fulltime')
        <div class="p-3">
          <span class="text-info p-2 rounded border border-info">{{$job->type}}</span>
        </div>
        @elseif($job->type=='parttime')
        <div class="p-3">
          <span class="text-warning p-2 rounded border border-warning">{{$job->type}}</span>
        </div>
        @elseif($job->type=='internship')
        <div class="p-3">
          <span class="text-danger p-2 rounded border border-danger">{{$job->type}}</span>
        </div>
        @endif

      </div>
      </a>
      <br>

      @endforeach
      @else
      <p style="color: red; font-weight:600;text-align:center">Sorry,No jobs found, Please try other combination!</p>
      @endif
    </div>
  </div>

  {{$jobs->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}

</div>

</div>




@endsection