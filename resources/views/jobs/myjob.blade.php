<style>
    .banner_image {
        background-image: url('/external/images/companyjob.jpg');
        height: 70%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
</style>
@extends('layouts.main')
@section('content')
@if(Session::has('message'))
<div class="alert alert-success">
    {{Session::get('message')}}
</div>
@endif
<div class="banner_image">
    <div class="content">
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/My jobs</h4>
    </div>
</div>
<div class="col-md-6 mt-5 mx-auto text-center mb-5 section-heading">
    <h2 style="font-family: cursive;">My Company Jobs</h2>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card" style="overflow-x:auto;">
                <div class="card-header">All Posted jobs</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @if(count($jobs)>0)
                            @foreach($jobs as $job)
                            <tr>
                                <td>
                                    @if(!empty(Auth::user()->company->logo))
                                    <img src="{{asset('companylogo')}}/{{$job->company->logo}}" width="60" height="60" style="border-radius: 50%;">
                                    @else
                                    <img src="{{asset('companylogo/logo.jpg')}}" alt="Image" width="60" height="60" style="border-radius: 50%;">
                                    @endif
                                </td>
                                <td>Position:{{Illuminate\Support\Str::limit($job->position,20)}}
                                    <br>
                                    @if($job->type=='fulltime')
                                    <span class="badge badge-success">{{$job->type}}</span>
                                    @elseif($job->type=='parttime')
                                    <span class="badge badge-success">{{$job->type}}</span>
                                    @else
                                    <span class="badge badge-success">{{$job->type}}</span>
                                    @endif
                                </td>
                                <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Address:{{Illuminate\Support\Str::limit($job->address,15)}}</td>
                                <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date:{{$job->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                        <button class="btn btn-success btn-sm "> Read
                                        </button>
                                    </a>
                                    <a href="{{route('job.edit',[$job->id])}}">
                                        <button class="btn btn-dark btn-sm ">Edit</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <p style="color: red; font-weight:600;text-align:center">Sorry,No jobs has been posted!</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection