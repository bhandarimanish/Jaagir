@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            @if(count($applicants)>0)
            @foreach($applicants as $applicant)
                <div class="card-header"><a href="{{route('jobs.show',[$applicant->id,$applicant->slug])}}"> {{$applicant->title}}</a></div>

                <div class="card-body">
            @foreach($applicant->users as $user)
                <table class="table" style=" border: 1px solid black;">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Address</th>
      <th>Gender</th>
      <th>Bio</th>
      <th>Experience</th>
      <th>Phone Number</th>
      <th>Resume</th>
      <th>Cover</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->profile->address}}</td>
      <td>{{$user->profile->gender}}</td>
      <td>{{$user->profile->bio}}</td>
      <td>{{$user->profile->experience}}</td>
      <td>{{$user->profile->phone_number}}</td>
      
      <td><a href="{{Storage::url($user->profile->resume)}}">Resume</a></td>

      <td><a href="{{Storage::url($user->profile->cover_letter)}}">Cover letter</a></td>

    </tr>
  </tbody>
</table>
                </div>
                @endforeach
                @endforeach
                @else
                <div class="mb-5 mt-2 ml-2">
              <p style="color: red;"> No,one has applied for this job!</p>
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
