<style>
  .banner_image {
    background-image: url('/external/images/jobcategory.jpg');
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
    <h4 style="color: white;"><a href="/" style="color:yellow"> Home </a>/{{$categoryName->name}} Jobs</h4>
  </div>
</div>
<div class="row">
  <div class="col-md-6 mt-5 mx-auto text-center  section-heading">
    <h2 class="mb-5" style="font-family: Noto Sans, sans-serif;">{{$categoryName->name}}</< /h2>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="rounded border jobs-wrap">
        @if(count($jobs)>0)
        @foreach($jobs as $job)

        <a href="{{route('jobs.show',[$job->id,$job->slug])}}" class="job-item d-block d-md-flex align-items-center  border-bottom @if($job->type=='parttime') partime @elseif($job->type=='fulltime')fulltime @else internship   @endif;">
          <div class="company-logo blank-logo text-center text-md-left pl-3">
          @if(!empty($job->company->logo))
                <img src="{{asset('companylogo')}}/{{$job->company->logo}}" alt="Image" class="img-fluid mx-auto">
                @else
                <img src="{{asset('companylogo/logos.png')}}" alt="Image" class="img-fluid mx-auto">
                @endif
          </div>
          <div class="job-details">
            <div class="p-3 align-self-center">
              <h3>{{$job->position}}</h3>
              <div class="d-block d-lg-flex">
                <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{$job->company->cname}}</div>
                <div class="mr-3"><span class="icon-room mr-1"></span> {{Str::limit($job->address,20)}}</div>
                <div><span class="icon-money mr-1"></span>{{$job->salary}}</div>
                <div>&nbsp;<span class="fa fa-clock-o mr-1"></span>{{$job->created_at->diffForHumans()}}</div>
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
              <span class="text-danger p-2 rounded border border-danger">{{$job->type}}</span>
            </div>
            @else
            <div class="p-3">
              <span class="text-warning p-2 rounded border border-warning">{{$job->type}}</span>
            </div>
            @endif

          </div>
        </a>
        <br>
        @endforeach
        @else
        <p class="mt-2 mb-2" style="color: red; font-weight:600;text-align:center">No jobs has been posted!</p>
        @endif


      </div>
    </div>

    {{$jobs->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}



  </div>
</div>
<br>

@endsection