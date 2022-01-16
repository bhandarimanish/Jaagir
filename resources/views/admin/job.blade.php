@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active " aria-current="page">All Jobs</li>
                </ol>
            </nav>
            <a class="btn btn-secondary mb-1" href="/dashboard"> <i class="fa fa-arrow-left"></i> Back
        </a>
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
            @if(Session::has('messages'))
            <div class="alert alert-danger">
                {{Session::get('messages')}}
            </div>
            @endif
            <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Created Date</th>
      <th scope="col">Position</th>
        <th>Company</th>

      <th scope="col">Status</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
  	  	@foreach($jobs as $job)

    <tr>
      <th scope="row">{{date('Y-m-d',strtotime($job->created_at))}}</th>
      <td>{{$job->position}}</td>
      <td>{{$job->company->cname}}</td>
      <td> @if($job->status=='0')
                   <a href="{{route('job.status',[$job->id])}}" class="badge badge-primary"> Draft</a>
                    @else
                   <a href="{{route('job.status',[$job->id])}}" class="badge badge-success"> Live</a>
                @endif</td>
      <td><a href="{{route('jobs.show',[$job->id,$job->slug])}}" target="_blank">Read</a></td>
    </tr>
      @endforeach

  </tbody>
</table>

{{$jobs->links()}}
        </div>
    </div>
</div>
@endsection