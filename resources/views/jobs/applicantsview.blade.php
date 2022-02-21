<style>
    span {
        font-weight: 700;
        padding-right: 10px;
    }
    .banner_image {
  background-image: url('/external/images/applicantsdetail.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Applicants Details</h4>
    </div>
</div>
<div class="container" style="overflow-x:auto;">
    <div class="row justify-content-center">
        <div class="col-md-6 mx-auto text-center mb-5 section-heading">
            <h2 class="mb-2 mt-5" style="font-family: cursive;">Applicants Detail</h2>
        </div>
        <div class="col-md-10">
            <div class="card" style="overflow-x:auto;">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                            <a href="{{route('job.applicant')}}" class="float-left"><i class="fa fa-arrow-left"> </i> Back </a>
                        <li class="list-group-item" style="text-align: center;"> @if(empty(Auth::user()->profile->avatar))
                            <img src="{{asset('avatar/man.png')}}" width="100" class="center-block" style="border-radius: 50%;">
                            @else
                            <img src="{{asset('avatar')}}/{{Auth::user()->profile->avatar}}" class="center-block" width="100" style="border-radius: 50%;text-align:center">
                            @endif
                            </li>
                            <li class="list-group-item"><span>Name:</span>{{$user->name}}</li>
                            <li class="list-group-item"><span>Email:</span>{{$user->email}}</li>
                            <li class="list-group-item"><span>Address:</span>{{$user->profile->address}}</li>
                            <li class="list-group-item"><span>Gender:</span>{{$user->profile->gender}}</li>
                            <li class="list-group-item"><span>Bio:</span>{{$user->profile->bio}}</li>
                            <li class="list-group-item"><span>Experience:</span>{{$user->profile->experience}}</li>
                            <li class="list-group-item"><span>Phone:</span>{{$user->profile->phone_number}}</li>
                            <li class="list-group-item"><span>Cover Letter:</span> <a href="{{Storage::url($user->profile->cover_letter)}}" target="blank">Cover letter</a></li>
                            <li class="list-group-item"><span>Resume:</span> <a href="{{Storage::url($user->profile->resume)}}" target="blank">Resume letter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection