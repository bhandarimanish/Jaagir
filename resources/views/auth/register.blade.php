@extends('layouts.main')
@section('content')
<div class="album text-muted">
    <div class="container">
        <div class="row">
            <h1>Seeker Registration</h1>
            <div class=" bg-light">
                <div class="container mt-4">
                    <div class="row">
                        @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                        @endif

                        <div class="col-md-12 col-lg-8 mb-5">
                            <form method="POST" action="{{ route('register') }}" class="p-5 bg-white">
                                @csrf

                                <input type="hidden" value="seeker" name="user_type">
                                <div class="form-group row">

                                    <div class="col-md-12">Name</div>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>

                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <div class="col-md-12">Email</div>

                                    <div class="col-md-12">
                                        <input id="email" type="text" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <div class="col-md-12">Password</div>

                                    <div class="col-md-12">
                                        <input id="password" type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" autofocus>

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">Confirm password</div>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="dob" class="col-md-12">{{ __('Date of birth') }}</label>

                                    <div class="col-md-6">
                                        <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" >

                                        @if ($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="gender" class="col-md-12">{{ __('Gender') }}</label>

                                    <div class="col-md-12">
                                        <input name="gender" type="radio" value="male" class="{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}">Male
                                        <input name="gender" type="radio" value="female" class="{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" >Female
                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>




                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <input type="submit" value="Register as Seeker" class="btn btn-primary  py-2 px-5">
                                    </div>
                                </div>


                            </form>
                        </div>

                        <div class="col-lg-4">


                            <div class="p-4 mb-3 bg-white">
                                <h3 class="h5 text-black mb-3">More Info</h3>
                                <p>Once you create an account a verification link will be sent to your email.</p>
                                <p><a href="#" class="btn btn-primary  py-2 px-4">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    @endsection