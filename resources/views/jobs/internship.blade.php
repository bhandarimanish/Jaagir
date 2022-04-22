<style>
    .banner_image {
        background-image: url('/external/images/internship.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: greenyellow;"> Home </a>/Internship</h4>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5 mx-auto text-center mb-5 section-heading">
            <h2 style="font-family: cursive;">Internship Opportunities</h2>
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
  <form action="{{route('internship')}}" method="GET">
            <input type="hidden" name="type" class="form-control" value="internship">
            <div class="form-inline font-weight-bold">
                <div class="form-group  ">
                    <label>Position:</label>
                    <input type="text" name="position" class="form-control" placeholder="job position" required>
                </div>
                <div class="form-group">
                    <label>Roles:</label>
                    <input type="text" name="roles" class="form-control" placeholder="skills..">
                </div>
                <div class="form-group">
                    <label>Category:</label>
                    <select name="category_id" class="form-control">
                        <option value="">-select-</option>

                        @foreach(App\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" name="address" class="form-control" placeholder="address">
                </div>

                <div class=" button form-group row d-flex justify-content-center align-content-center ml-1">
                    <input type="submit" class="btn btn-search btn-warning btn-sm btn-block" value="Search">

                </div>
            </div> <br>

        </form>

    <div class="col-md-12">
      <div class="rounded border jobs-wrap" style="background-color: #f0edf5;">
        @if(count($internships)>0)
        @foreach($internships as $internship)

        <a href="{{route('jobs.show',[$internship->id,$internship->slug])}}" class="job-item d-block d-md-flex align-items-center  border-bottom @if($internship->type=='parttime') partime @elseif($internship->type=='fulltime')fulltime @else internship   @endif;">
          <div class="company-logo blank-logo text-center text-md-left pl-3">
            @if(!empty($internship->company->logo))
            <img src="{{asset('companylogo')}}/{{$internship->company->logo}}" alt="Image" class="img-fluid mx-auto">
            @else
            <img src="{{asset('companylogo/logo.jpg')}}" alt="Image" class="img-fluid mx-auto">
            @endif
          </div>
          <div class="job-details">
            <div class="p-3 align-self-center">
              <h3>{{$internship->position}}</h3>
              <div class="d-block d-lg-flex">
                <div class="mr-3"><span class="icon-suitcase  font-weight-bold"></span> {{$internship->company->cname}}</div>
                <div class="mr-3"><span class="icon-room font-weight-bold"></span> {{Str::limit($internship->address,20)}}</div>
                <div class="mr-3"><span class="fa fa-money mr-1 font-weight-bold"></span>{{$internship->salary}}</div>
                <div class="mr-3"><span class="fa fa-clock-o mr-1 font-weight-bold"></span>{{$internship->created_at->diffForHumans()}}</div>
                @if ($internship->last_date < Carbon\Carbon::now())
                <div class="mr-3"><span class="fa fa-bell-slash-o mr-1 font-weight-bold"></span>
                   <p class="badge badge-danger">expired</p>
                </div>
                @endif
              </div>
            </div>
          </div>
          <div class="job-category align-self-center">
            <div class="p-3">
              <span class="text-info p-2 rounded border border-info">{{$internship->type}}</span>
            </div>
          </div>
        </a>
        <br>

        @endforeach
        @else
        <p style="color: red; font-weight:600;text-align:center">Sorry,No internships found, Please try other combination!</p>
        @endif
      </div>
    </div>
    {{$internships->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}
  </div>
</div>
@endsection