@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">My jobs</div>

                <div class="card-body">
                    <table class="table">

                        <tbody>
                            @if(count($jobs)>0)
                            @foreach($jobs as $job)
                            <tr>
                                <td>
                                    @if(!empty(Auth::user()->company->logo))
                                    <img src="{{asset('companylogo')}}/{{$job->company->logo}}" height="100" width="100">
                                    @else
                                    <img src="{{asset('companylogo/logo.jpg')}}" alt="Image" height="100" width="100" >
                                    @endif
                                </td>
                                <td>Position:{{$job->position}}
                                    <br>
                                    <i class="fa fa-clock" aria-hidden="true"></i>&nbsp;{{$job->type}}
                                </td>
                                <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Address: {{$job->address}}</td>
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
                            @else
                            <div class="mb-5 mt-2 ml-2">
                                <p style="color: red;"> No job has been posted by this company!</p>
                            </div>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection