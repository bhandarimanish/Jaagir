<style>
    table,
    th,
    td {
        border: 1px solid black;
    }

    .banner_image {
        background-image: url('/external/images/myjob.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Applied Job</h4>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(count($jobs)>0)
            @foreach($jobs as $job)
            <div class="card mt-3 mb-4" style="overflow-x:auto;">
                <div class="card-header"><a href="{{route('jobs.show',[$job->id,$job->slug])}}"> {{$job->title}}</a></div>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Image</th>
                            <th>Company</th>
                            <th>Address</th>
                            <th>Experience</th>
                            <th>Posted</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> @if(empty($job->company->logo))
                                <img src="{{asset('companylogo/logos.png')}}" width="50" class="center-block" style="border-radius: 50%;">
                                @else
                                <img src="{{asset('companylogo')}}/{{$job->company->logo}}" width="50" class="center-block" style="border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{Str::limit($job->company->cname,20)}}</td>
                            <td>{{Str::limit($job->company->address,20)}}</td>
                            <td>{{$job->experience}}&nbsp;year</td>
                            <td>{{$job->created_at->diffForHumans()}}</td>
                            <?php
                            $data = \DB::table('job_user')->where('user_id', auth()->user()->id)->where('job_id', $job->id)->get();
                            ?>
                            <td style="font-size:22"> @if($data[0]->status=='0')
                                <span class="badge alert-danger">Rejected</span>
                                @elseif($data[0]->status=='1')
                                <span class="badge alert-success">Accepted</span>
                                @else
                                <span class="badge alert-warning text-black">Pending</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="container">
                    <strong> Message from Company:</strong> @if(!empty($data[0]->description))
                    <span> {{$data[0]->description}} </span>
                    @else
                    <span style="color: red;">No response yet.</span>
                    @endif
                    </p>
                </div>
            </div>
            @endforeach
            @else
            <p class="mt-2 mb-2" style="color: red; font-weight:600;text-align:center">No-one, has applied till the date!</p>
            @endif
        </div>
    </div>
</div>
@endsection