@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        @if(empty($company->cover_photo))
            <img src="{{asset('companycoverphoto/cover.png')}}" style="width: 100%;height:200px">
            @else
            <img src="{{asset('companycoverphoto')}}/{{$company->cover_photo}}" style="width: 100%;height:200px">
            @endif
            <br><br>

            <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">@csrf

            <div class="card">
                <div class="card-header">Update Logo</div>
                <div class="card-body">
                    <input type="file" class="form-control" name="logo" required>
                    <br>
                    <button class="btn btn-dark float-right" type="submit">Update</button>
                    @if($errors->has('logo'))
                            <div class="error" style="color: red;">{{$errors->first('logo')}}</div>
                        @endif

                </div>
            </div>
        </form>


        </div>

        <div class="col-md-5">
            @if(Session::has('message'))
                 <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
             <div class="card">
                <div class="card-header">Update Your Company Information</div>


                <form action="{{route('company.store')}}" method="POST">@csrf


                <div class="card-body">
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address"  value="{{Auth::user()->company->address}}">
                        @if($errors->has('address'))
                            <div class="error" style="color: red;">{{$errors->first('address')}}</div>
                        @endif

                    </div>


                    <div class="form-group">
                        <label for="">Phone number</label>
                        <input type="text" class="form-control" name="phone"  value="{{Auth::user()->company->phone}}">
                        @if($errors->has('phone'))
                            <div class="error" style="color: red;">{{$errors->first('phone')}}</div>
                        @endif
                    </div>

                    
                    <div class="form-group">
                        <label for="">Website</label>
                        <input type="text" class="form-control" name="website"  value="{{Auth::user()->company->website}}">
                        @if($errors->has('website'))
                            <div class="error" style="color: red;">{{$errors->first('website')}}</div>
                        @endif
                    </div>

                    
                  
                    <div class="form-group">
                        <label for="">Slogan</label>
                        <input type="text" class="form-control" name="slogan"  value="{{Auth::user()->company->slogan}}">
                        @if($errors->has('slogan'))
                            <div class="error" style="color: red;">{{$errors->first('slogan')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                       <textarea name="description" class="form-control">{{Auth::user()->company->description}}</textarea>
                       @if($errors->has('description'))
                            <div class="error" style="color: red;">{{$errors->first('description')}}</div>
                        @endif
                    </div>
                
                    <div class="form-group">
                        <button class="btn btn-dark" type="submit">Update</button>
                    </div>

                </div>
            </div>

            

        </div>


</form>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">About your Company</div>
                <div class="card-body">
       <p>Company Name:{{Auth::user()->company->cname}}</p>
       <p>Company Address:{{Auth::user()->company->address}}</p>
       <p>Company Phone:{{Auth::user()->company->phone}}</p>
       <p>Company Website:<a href="">{{Auth::user()->company->website}}</a></p>
       <p>Company Slogan:{{Auth::user()->company->slogan}}</p>
       <p>Company Page: <a href="company/{{Auth::user()->company->slug}}">View</a></p>

                </div>
            </div>
        <br>
        <form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="card">
                <div class="card-header">Update coverphoto</div>
                <div class="card-body">
                <input type="file" class="form-control" name="cover_photo" required><br>
                    <button class="btn btn-dark float-right" type="submit">Update</button>
                    @if($errors->has('cover_photo'))
                            <div class="error" style="color: red;">{{$errors->first('cover_photo')}}</div>
                        @endif
                </div>
            </div>
        </form>


        </div>

    </div>
</div>
@endsection

