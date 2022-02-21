<style>
  table,
  th,
  td {
    border: 1px solid black;
  }
   .banner_image {
  background-image: url('/external/images/applicants.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Applicants</h4>
    </div>
</div>
<div class="applicants">
  <div class="row justify-content-center">
    <div class="mt-5 col-md-6 mx-auto text-center mb-5 section-heading">
      <h2 class="mb-2" style="font-family: cursive;">Applicants</h2>
    </div>
    <div class="col-md-10">
      <div class="card" style="overflow-x:auto;">
        @if(count($applicants)>0)
        @foreach($applicants as $applicant)
        <div class="card-header font-weight-bold "><a href="{{route('jobs.show',[$applicant->id,$applicant->slug])}}"> {{$applicant->title}}</a></div>
        @foreach($applicant->users as $user)
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Resume</th>
              <th>Cover</th>
              <th><a href="#" class="btn-sm btn-primary text-green" data-toggle="modal" data-target="#jobstatus{{$user->id}}">
                  Approve/Reject
                </a></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> @if(empty(Auth::user()->profile->avatar))
                <img src="{{asset('avatar/man.png')}}" width="30" class="center-block" style="border-radius: 50%;">
                @else
                <img src="{{asset('avatar')}}/{{Auth::user()->profile->avatar}}" class="center-block" width="30" style="border-radius: 50%;text-align:center">

                @endif
              </td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->profile->address}}</td>
              <td>{{$user->profile->phone_number}}</td>
              <td><a href="{{Storage::url($user->profile->resume)}}" target="blank">Resume</a></td>
              <td><a href="{{Storage::url($user->profile->cover_letter)}}" target="blank">Cover letter</a></td>
              <?php
              $data = \DB::table('job_user')->where('user_id', $user->id)->where('job_id', $applicant->id)->get();
              ?>
              <td style="font-size:22"> @if($data[0]->status=='0')
                <span class="badge alert-danger">Rejected</span>
                @elseif($data[0]->status=='1')
                <span class="badge alert-success">Accepted</span>
                @else
                <span class="badge alert-warning text-black">Pending</span>
                @endif
              </td>
              <td><a href="{{route('job.applicantview',$user->id)}}"><i class="fa fa-eye fa-lg" style="color:blue"></i></a></td>
              <div class="modal fade" id="jobstatus{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="jobstatusLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="{{route('accept.reject',[$applicant->id])}}" method="post">
                    @csrf
                    <input type="hidden" name="userid" value="{{$user->id}}">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="jobstatusLabel">Accept/Reject Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required="">
                              <option value="1">Accept</option>
                              <option value="0">Reject</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required=""></textarea>

                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </tr>
          </tbody>
        </table>
        @endforeach
        @endforeach
        @else
        <p class="mt-2 mb-2" style="color: red; font-weight:600;text-align:center">No-one, has applied till the date!</p>
        @endif
      </div>
    </div>
  </div>
</div>
<br>
@endsection