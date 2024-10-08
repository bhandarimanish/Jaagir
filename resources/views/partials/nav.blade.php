<div class="site-wrap">
  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->

  <div class="row" style="background-color:#f0f6fa;">
    <div class="container">
      <div class="site-navbar bg-light">
        <div class="py-1">
          <div class="row align-items-center" style="background-color: #f0f6fa;">
            <div class="col-2">
              <a href="/"><img src="{{asset('avatar/logos.png')}}" alt="" height="80" width="200"></a>
            </div>
            <div class="col-10">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>
                  <ul class="site-menu js-clone-nav d-none d-lg-block" style="font-family:Work Sans;font-weight: 600;font-stretch: extra-expanded">
                    @guest
                    <li><a href="/register">For Job seeker</a></li>
                    <li>
                      <a href="{{route('employer.register')}}">For Employer</a>

                    </li>
                    <li>
                      <a href="{{route('internship')}}">Internship</a>

                    </li>
                    <li><a href="{{route('company')}}">Company</a></li>
                    @endguest
                    @if(Auth::check()&&Auth::user()->user_type=='seeker'&&Auth::user()->email_verified_at)
                    <li> <a href="{{route('internship')}}">Internship</a> </li>
                    <li> <a href="{{route('myjob.user')}}">My jobs</a> </li>
                    <li><a href="/home">Dashboard</a></li>
                    <li><a href="{{route('user.profile')}}">Profile</li>
                    @elseif(Auth::check()&&Auth::user()->user_type=='seeker'&&!Auth::user()->email_verified_at)
                    <li style="color: red;">Please, first verify your email!!</li>
                    <li><a href="/home">Dashboard</li>
                    @elseif(Auth::check()&&Auth::user()->user_type=='admin')
                    <li><a href="/dashboard">Dashboard</li>
                    @endif
                    @if(Auth::check()&&Auth::user()->user_type=='employer'&&Auth::user()->email_verified_at)
                    <li><a href="{{route('company.profile')}}">Update Profile</a></li>
                    <li><a href="{{route('job.applicant')}}">Applicants</a></li>
                    <li><a href="{{route('job.mine')}}">My Jobs</a></li>
                    <li><a href="{{route('job.create')}}" class="btn btn-warning text-white">Post a Job</a></li>
                    @endif

                    <li>
                      @if(!Auth::check())

                      <button type="button" class="btn btn-primary text-white py-3 px-4 rounded" data-toggle="modal" data-target="#exampleModal" style="background-color: #2374e1;color:white">
                        Login
                      </button>
                      @else
                      <a href="{{ route('logout') }}" class="btn btn-danger text-white rounded text-center" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="background-color:#de0202;">
                        Logout &nbsp;
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>

                      @endif
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!--modal-->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

              <div class="col-md-12">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

              <div class="col-md-12">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-4 col-form-label text-md-left">
                <div class="form-check  ">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label " for="remember">
                    {{ __('Remember Me') }}
                  </label>
                </div>
              </div>
            </div>

            <!-- <div class="form-group row mb-0">
              <div class="col-md-8 col-form-label text-md-left">
                @if (Route::has('password.request'))
                <a class="btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
                @endif
              </div>
            </div> -->




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
          </button>
          </form>

        </div>
      </div>
    </div>
  </div>

  @if(isset($errors)&&count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif