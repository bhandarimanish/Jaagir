<style>
    .banner_image {
        background-image: url('external/images/homepage.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Company</h4>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-4 mx-auto text-center mb-5 section-heading">
            <h2 style="font-family: cursive;">Recommended Jobs</h2>
        </div>
    </div>
    <div class="row">
        @if(isset(Auth::user()->profile->address))
        @foreach($jobRecommendations as $jobRecommendation)
        <div class="col-sm-4 col-md-4 col-lg-3 mb-5 justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="card feature-item" style="background-color:#f2f7ff;">
                <p class="badge badge-success">{{$jobRecommendation->type}}</p>
                <h5 class="card-title">{{$jobRecommendation->position}}</h5>
                <p class="card-text">{!!\Illuminate\Support\Str::limit($jobRecommendation->description,20)!!}
                    <center> <a href="{{route('jobs.show',[$jobRecommendation->id,$jobRecommendation->slug])}}" class="btn btn-success">Apply</a></center>
            </div>
        </div>
        @endforeach
        @else
        <p class="ml-4 font-weight-bold">First update your profile to get recommended jobs!</p>
        @endif
    </div>
</div>

<div class="container">
    <div class="">
        <div class="col-md-12">
            <div class="col-md-6 mt-4 mx-auto text-center mb-5 section-heading">
                <h2 style="font-family: cursive;">Saved Jobs</h2>
            </div>
            @if(Auth::user()->user_type=='seeker')
            @if(count($jobs)>0)
            @foreach($jobs as $job)
            <div class="card">
                <div class="card-header"><a href="{{route('jobs.show',[$job->id,$job->slug])}}">{{$job->title}}</a></div>
                <div class="card-body">
                    <small class="badge badge-success">{{$job->position}}
                    </small>

                    <p> {!!$job->description!!}</p>
                </div>
                <div class="card-footer">
                    <span><a href="{{route('jobs.show',[$job->id,$job->slug])}}">Read</a></span>
                    <span class="float-right">Last date:{{$job->last_date}}</span>
                </div>
            </div>
            <br>
            @endforeach
            @else
            <p class=" mr-3 mb-5"><b>You have not favourited any jobs to show.</b>
                <a href="{{route('job.all')}}">Find Jobs</a>
            </p>
            @endif
            @else
            You're logged in!
            @endif
        </div>
    </div>
</div>

@endsection