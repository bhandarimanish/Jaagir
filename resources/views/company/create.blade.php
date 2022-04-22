<style>
   .banner_image {
  background-image: url('/external/images/companyprofile.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Update Profile</h4>
    </div>
</div>
<div class="col-md-6 mt-4 mx-auto text-center mb-5 section-heading">
            <h2 style="font-family: cursive;">Update Company Details</h2>
        </div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->company->logo))
            <img src="{{asset('companylogo/logos.png')}}" class="center" style="width: 100%;height:200px;border-radius:50%;">
            @else
            <img width="100" class="center" src="{{asset('companylogo')}}/{{Auth::user()->company->logo}}" style="width: 100%;height:200px;border-radius:50%;">
            @endif
            <br><br>
            <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">@csrf

                <div class="card">
                    <div class="card-header font-weight-bold justify-content-center text-center">Update Logo</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="logo" required>
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('logo'))
                        <div class="error" style="color: red;">{{$errors->first('logo')}}</div>
                        @endif

                    </div>
                </div>
            </form>


        </div>

        <div class="col-md-5 mb-4">
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header font-weight-bold justify-content-center text-center">Update Your Company Information</div>
                <form action="{{route('company.store')}}" method="POST">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Address:</label>
                            <input type="text" class="form-control" name="address" value="{{Auth::user()->company->address}}">
                            @if($errors->has('address'))
                            <div class="error" style="color: red;">{{$errors->first('address')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="">Phone number:</label>
                            <input type="text" class="form-control" name="phone" value="{{Auth::user()->company->phone}}">
                            @if($errors->has('phone'))
                            <div class="error" style="color: red;">{{$errors->first('phone')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="">Website:</label>
                            <input type="text" class="form-control" name="website" value="{{Auth::user()->company->website}}">
                            @if($errors->has('website'))
                            <div class="error" style="color: red;">{{$errors->first('website')}}</div>
                            @endif
                        </div>



                        <div class="form-group">
                            <label for="">Slogan:</label>
                            <input type="text" class="form-control" name="slogan" value="{{Auth::user()->company->slogan}}">
                            @if($errors->has('slogan'))
                            <div class="error" style="color: red;">{{$errors->first('slogan')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Description:</label>
                            <textarea name="description" class="summernote form-control">{{Auth::user()->company->description}}</textarea>
                            @if($errors->has('description'))
                            <div class="error" style="color: red;">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header font-weight-bold justify-content-center text-center">About your Company</div>
                <div class="card-body">
                    <p><i>Company Name:</i>{{Auth::user()->company->cname}}</p>
                    <p><i>Company Address:</i>{{Auth::user()->company->address}}</p>
                    <p><i>Company Phone:</i>{{Auth::user()->company->phone}}</p>
                    <p><i>Company Website:</i><a href="http://{{Auth::user()->company->website}}" target="blank">{{Auth::user()->company->website}}</a></p>
                    <p><i>Company Slogan:</i>{{Auth::user()->company->slogan}}</p>
                    <p><i>Company Page:</i> <a href="company/{{Auth::user()->company->slug}}">View</a></p>
                </div>
            </div>
            @if(empty($company->cover_photo))
            <img src="{{asset('companycoverphoto/cover.png')}}" style="width: 100%;height:160px">
            @else
            <img src="{{asset('companycoverphoto')}}/{{$company->cover_photo}}" style="width: 100%;height:160px">
            @endif
            <form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card mt-4">
                    <div class="card-header font-weight-bold justify-content-center text-center">Update coverphoto</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="cover_photo" required><br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('cover_photo'))
                        <div class="error" style="color: red;">{{$errors->first('cover_photo')}}</div>
                        @endif
                    </div>
                </div>
            </form>


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