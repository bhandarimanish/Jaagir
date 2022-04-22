<style>
    .banner_image {
        background-image: url('/external/images/profile.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Update Profile</h4>
    </div>
</div>
<div class="container" style="overflow-x:auto ;">
    <div class="mt-4 col-md-12 mt-3 mb-4">
        <div class="card" style="overflow-x:auto ;">
            <div class="card-header  font-weight-bold text-center">Profile Information</div>
            <div class="card-body">
                <table class="table  table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Coverletter</th>
                            <th scope="col">Resume</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{Auth::user()->name}}</td>
                            <td>{{Auth::user()->email}}</td>
                            <td>{{Auth::user()->profile->address}}</td>
                            <td>{{Auth::user()->profile->phone_number}}</td>
                            @if(!empty(Auth::user()->profile->cover_letter))
                            <td><a href="{{Storage::url(Auth::user()->profile->cover_letter)}}" target="blank">Cover letter</a></td>
                            @else
                            <td style="color:red">Please upload cover letter!</td>
                            @endif

                            @if(!empty(Auth::user()->profile->resume))
                            <td><a href="{{Storage::url(Auth::user()->profile->resume)}}" target="blank">Resume</a></td>
                            @else
                            <td style="color: red;">Please upload resume!</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->profile->avatar))
            <img src="{{asset('avatar/man.png')}}" style="width: 100%;height:200px">
            @else
            <img src="{{asset('avatar')}}/{{Auth::user()->profile->avatar}}" style="width: 100%;height:200px">

            @endif
            <br><br>

            <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header font-weight-bold">Update profile picture</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="avatar">
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('avatar'))
                        <div class="error" style="color: red;">{{$errors->first('avatar')}}</div>
                        @endif

                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-header  font-weight-bold">Update Your Profile</div>
                <form action="{{route('profile.create')}}" method="POST">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" value="{{Auth::user()->profile->address}}">
                            @if($errors->has('address'))
                            <div class="error" style="color: red;">{{$errors->first('address')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Phone number</label>
                            <input type="text" class="form-control" name="phone_number" value="{{Auth::user()->profile->phone_number}}">
                            @if($errors->has('phone_number'))
                            <div class="error" style="color: red;">{{$errors->first('phone_number')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="jobtitle">Job Position:</label>
                            <input type="text" name="jobtitle" class="form-control {{ $errors->has('jobtitle') ? ' is-invalid' : '' }}" value="{{Auth::user()->profile->jobtitle}}">
                            @if ($errors->has('jobtitle'))
                            <div class="error" style="color: red;">{{$errors->first('jobtitle')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="type">Job Type:</label>
                            <select class="form-control" name="jobtype" id="available">
                                <option value="fulltime" {{ Auth::user()->profile->jobtype=='fulltime'?'selected':''}}>fulltime</option>
                                <option value="partime" {{ Auth::user()->profile->jobtype=='partime'?'selected':''}}>partime</option>
                                <option value="internship" {{ Auth::user()->profile->jobtype=='internship'?'selected':''}}>internship</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category" class="form-control">
                                @foreach(App\Category::all() as $cat)
                                <option value="{{$cat->id}}" {{$cat->id== Auth::user()->profile->category?'selected':''}}>{{$cat->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="type">Expected Salary/month(RS):</label>
                            <select class="form-control" name="salary">
                                <option value="negotiable" {{ Auth::user()->profile->salary=='negotiable'?'selected':''}}>Negotiable</option>
                                <option value="5000-10000" {{ Auth::user()->profile->salary=='5000-10000'?'selected':''}}>5000-10000</option>
                                <option value="10000-20000" {{ Auth::user()->profile->salary=='10000-20000'?'selected':''}}>10000-20000</option>
                                <option value="20000-30000" {{ Auth::user()->profile->salary=='20000-30000'?'selected':''}}>20000-30000</option>
                                <option value="30000-40000" {{ Auth::user()->profile->salary=='30000-40000'?'selected':''}}>30000-40000</option>
                                <option value="40000-50000" {{ Auth::user()->profile->salary=='40000-50000'?'selected':''}}>40000-50000</option>
                                <option value="50000 plus" {{ Auth::user()->profile->salary=='50000 plus'?'selected':''}}>50000 plus</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Experience(in yr)</label>
                            <input type="number" name="experience" class="form-control" value="{{Auth::user()->profile->experience}}">
                            @if($errors->has('experience'))
                            <div class="error" style="color: red;">{{$errors->first('experience')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="">Skills</label>
                            <textarea name="skill" class="summernote form-control">{{Auth::user()->profile->skill}}</textarea>
                            @if($errors->has('skill'))
                            <div class="error" style="color: red;">{{$errors->first('skill')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                </form>
            </div>
        </div>
    </div>



    <div class="col-md-4">
        <div class="card">
            <form action="{{route('cover.letter')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header  font-weight-bold">Update coverletter</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="cover_letter" required><br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('cover_letter'))
                        <div class="error" style="color: red;">{{$errors->first('cover_letter')}}</div>
                        @endif
                    </div>
                </div>
            </form>
            <br>
            <br>
            <br>
            <br>
            <form action="{{route('resume')}}" method="POST" enctype="multipart/form-data">@csrf

                <div class="card">
                    <div class="card-header  font-weight-bold">Update resume</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="resume" required>
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('resume'))
                        <div class="error" style="color: red;">{{$errors->first('resume')}}</div>
                        @endif
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('.summernote').summernote({
        height: 150
    });
</script>
@endsection