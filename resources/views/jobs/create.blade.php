<style>
    .banner_image {
        background-image: url('/external/images/createjob.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Create a job</h4>
    </div>
</div>
<div class="col-md-6 mt-4 mx-auto text-center mb-5 section-heading">
    <h2 style="font-family: cursive;">Job Creation</h2>

</div>

<div class="container mb-3">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4 mb-4">
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
            @if(Auth::check()&&Auth::user()->user_type=='employer'&&!Auth::user()->company->address)
            <p style="color: red; font-weight:600;text-align:center">To create the job, Please update your profile first.</p>
            @elseif($count!==0)
            <p style="color: red; font-weight:600;text-align:center">Please accept/reject applicants of previous job to create new one!</p>
            @endif
            <div class="card bg-light">
                <div class="card-header font-weight-bold  text-center">Create a job</div>
                <div class="card-body">

                    <form action="{{route('job.store')}}" method="POST">@csrf

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="summernote form-control {{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category" class="form-control">
                                @foreach(App\Category::all() as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" name="position" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ old('position') }}">
                            @if ($errors->has('position'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('position') }}</strong>
                            </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="role">Role and Responsibilities:</label>
                            <textarea name="roles" class="summernote form-control {{ $errors->has('roles') ? ' is-invalid' : '' }}">{{old('roles')}}</textarea>
                            @if ($errors->has('roles'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('roles') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>




                        <div class="form-group">
                            <label for="number_of_vacancy">No of vacancy:</label>
                            <input type="number" name="number_of_vacancy" class="form-control{{ $errors->has('number_of_vacancy') ? ' is-invalid' : '' }}" value="{{ old('number_of_vacancy') }}">
                            @if ($errors->has('number_of_vacancy'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('number_of_vacancy') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="experience">Year of experience:</label>
                            <input type="number" name="experience" class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}" value="{{ old('experience') }}">
                            @if ($errors->has('experience'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('experience') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="type">Gender:</label>
                            <select class="form-control" name="gender">
                                <option value="any">Any</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Salary/month(RS):</label>
                            <select class="form-control" name="salary">
                                <option value="negotiable">Negotiable</option>
                                <option value="5000-10000">5000-10000</option>
                                <option value="10000-20000">10000-20000</option>
                                <option value="20000-30000">20000-30000</option>
                                <option value="30000-40000">30000-40000</option>
                                <option value="40000-50000">40000-50000</option>
                                <option value="50000 plus">50000 plus</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Available for:</label>
                            <select class="form-control" name="type" id="available">
                                <option value="fulltime">fulltime</option>
                                <option value="parttime">parttime</option>
                                <option value="internship">internship</option>
                            </select>
                        </div>

                        <div class="form-group" id="business" style="display: none;">
                            <label >Resources *:</label>
                            <textarea name="resources" class="summernote form-control {{ $errors->has('resources') ? ' is-invalid' : '' }}">{{ old('resources') }}</textarea>
                            @if ($errors->has('resources'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('resources') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" name="status">
                                <option value="1">live</option>
                                <option value="0">draft</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lastdate">Last date:</label>
                            <input type="date" name="last_date" class="form-control {{ $errors->has('last_date') ? ' is-invalid' : '' }}" value="{{ old('last_date') }}">
                            @if ($errors->has('last_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_date') }}</strong>
                            </span>
                            @endif
                        </div>
                        @if(Auth::check()&&Auth::user()->user_type=='employer'&&!Auth::user()->company->address)
                        <p style="color: red; font-weight:600;">Please update your profile first.</p>
                        <button class="btn btn-danger" disabled>Submit</button>
                        @elseif($count!==0)
                        <p style="color: red; font-weight:600;">Please accept/reject applicants of previous job to create new one!</p>
                        <button class="btn btn-danger" disabled>Submit</button>
                        @else
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                        @endif
                        </form>
                </div>
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


<script type="text/javascript">
    $(function() {
        $("#available").change(function() {
            if ($(this).val() == "internship") {
                $("#business").show();
            } else {
                $("#business").hide();
            }
        });
    });
</script>
@endsection