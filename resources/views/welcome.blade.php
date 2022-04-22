
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Jaagir &nbsp; We help you to grow!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @include('partials.head')

</head>
<style>
  .job-item {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
  }
</style>

<body>
  @include('partials.nav')

  @include('partials.hero')

  @include('partials.category')


  <div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-md-0" data-aos="fade-up" data-aos-delay="100">
          <div class="row">
            <div class="col-md-6 mx-auto text-center  section-heading">
              <h2 class="mb-5" style="font-family: Noto Sans, sans-serif;">Recent Jobs</h2>
            </div>
          </div>
          <div class=" rounded border jobs-wrap">
            @if(count($jobs)>0)
            @foreach($jobs as $job)

            <a href="{{route('jobs.show',[$job->id,$job->slug])}}" class="job-item mb-2 d-block d-md-flex
   align-items-center  border-bottom @if($job->type=='parttime') 
   partime @elseif($job->type=='fulltime')fulltime @else internship   @endif;
   ">
              <div class="company-logo blank-logo text-center text-md-left pl-3">
                @if(!empty($job->company->logo))
                <img src="{{asset('companylogo')}}/{{$job->company->logo}}" alt="Image" class="img-fluid mx-auto">
                @else
                <img src="{{asset('companylogo/logos.png')}}" alt="Image" class="img-fluid mx-auto">
                @endif
              </div>
              <div class="job-details h-100">
                <div class="p-3 align-self-center">
                  <h3>{{$job->position}}</h3>
                  <div class="d-block d-lg-flex">
                    <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{$job->company->cname}}</div>
                    <div class="mr-3"><span class="icon-room mr-1"></span> {{Str::limit($job->address,20)}}</div>
                    <div><span class="icon-money mr-1"></span>{{$job->salary}}</div>
                  </div>
                </div>
              </div>
              <div class="job-category align-self-center">
                @if($job->type=='fulltime')
                <div class="p-3">
                  <span class="text-info p-2 rounded border border-info">{{$job->type}}</span>
                </div>
                @elseif($job->type=='parttime')
                <div class="p-3">
                  <span class="text-warning p-2 rounded border border-warning">{{$job->type}}</span>
                </div>
                @elseif($job->type=='internship')
                <div class="p-3">
                  <span class="text-danger p-2 rounded border border-danger">{{$job->type}}</span>
                </div>
                @endif
              </div>
              @endforeach
              @else
              <b style="color: red;"> Sorry,There are not any latest jobs!!</b>
              @endif
            </a>
          </div>

          <div class="col-md-12 text-center mt-5">
            <a href="{{route('job.all')}}" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More Jobs</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('partials.testimonial')

  @if(!Auth::check())
  <div class="site-blocks-cover overlay inner-page" style="background-image: url('external/images/hero_2.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-6 text-center" data-aos="fade">
          <h1 class="h3 mb-0">Your Dream Job</h1>
          <p class="h3 text-white mb-5">Is Waiting For You</p>
          <p><a href="/register" class="btn btn-outline-success py-3 px-4">Job Seeker</a>
            <a href="{{route('employer.register')}}" class="btn btn-outline-warning py-3 px-4">Job Employer</a>
          </p>

        </div>
      </div>
    </div>
  </div>
  @endif



  <!-- <div class="site-section site-block-feature bg-light">
    <div class="container">

      <div class="text-center mb-5 section-heading">
        <h2>Why Choose Us</h2>
      </div>

      <div class="d-block d-md-flex border-bottom">
        <div class="text-center p-4 item border-right" data-aos="fade">
          <span class="flaticon-worker display-3 mb-3 d-block text-primary"></span>
          <h2 class="h4">More Jobs Every Day</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
          <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
        </div>
        <div class="text-center p-4 item" data-aos="fade">
          <span class="flaticon-wrench display-3 mb-3 d-block text-primary"></span>
          <h2 class="h4">Creative Jobs</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
          <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
        </div>
      </div>
      <div class="d-block d-md-flex">
        <div class="text-center p-4 item border-right" data-aos="fade">
          <span class="flaticon-stethoscope display-3 mb-3 d-block text-primary"></span>
          <h2 class="h4">Healthcare</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
          <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
        </div>
        <div class="text-center p-4 item" data-aos="fade">
          <span class="flaticon-calculator display-3 mb-3 d-block text-primary"></span>
          <h2 class="h4">Finance &amp; Accounting</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
          <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
        </div>
      </div>
    </div>
  </div> -->

  @include('partials.blog')

  @include('partials.footer')

</body>

</html>