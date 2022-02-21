<style>
   .banner_image {
  background-image: url('/external/images/registration.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Employer Registration</h4>
    </div>
</div>
<div class="row">
  <div class="col-md-6 mx-auto text-center  section-heading">
    <h2 class="mb-5 mt-5" style="font-family: Noto Sans, sans-serif;">Employer Registration</h2>
  </div>
</div>
<div class="album text-muted">
  <div class="container">
    <div class="row">
      <div class="card bg-light">
        <div class="container mt-4">
          <div class="row">
            @if(Session::has('message'))
            <div class="alert alert-success">
              {{Session::get('message')}}
            </div>
            @endif

            <div class="col-md-12 col-lg-8 mb-3">

              <form method="POST" action="" class="p-5 bg-white">
                @csrf

                <input type="hidden" value="employer" name="user_type">
                <div class="form-group row">

                  <div class="col-md-12">Company name</div>

                  <div class="col-md-12">
                    <input id="name" type="text" placeholder="Company name" class="form-control{{ $errors->has('cname') ? ' is-invalid' : '' }}" name="cname" value="{{ old('cname') }}" autofocus>

                    @if ($errors->has('cname'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('cname') }}</strong>
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




                <div class="row form-group">
                  <div class="col-md-12">
                    <input type="submit" value="Register as Employer" class="btn btn-primary  py-2 px-5">
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
  <br>
  @endsection