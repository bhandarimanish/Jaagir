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
      <th scope="col">Action</th>
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
      <td>  <a href="#" data-toggle="modal" data-target="#exampleModal{{$job->id}}">
      <i class="nav-icon fa fa-trash fa-1x" style="color: red;"> </i></a>

                            <div class="modal fade" id="exampleModal{{$job->id}}" tabindex="-1" news="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" news="document">
                                    <form action="{{route('job.delete',[$job->id])}}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }} 
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                               <b> Do you really want to delete?</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div></td>
    </tr>
      @endforeach

  </tbody>
</table>

{{$jobs->links()}}
        </div>
    </div>
</div>
@endsection