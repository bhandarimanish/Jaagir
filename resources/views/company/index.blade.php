<style>
    .banner_image {
        background-image: url('/external/images/meeting.jpg');
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
        <h4 style="color: white;"><a href="/" style="color:yellow;"> Home </a>/Company</h4>
    </div>
</div>
<div class="album text-muted"  style="overflow-x:auto;">
    <div class="container">
        <div class="row " id="app">
            <div class="col-md-6 mx-auto text-center mb-5 section-heading">
                <h2 class="mt-5 mb-2" style="font-family: cursive;">{{$company->cname}}</h2>
            </div>
            @if(empty($company->cover_photo))
            <img src="{{asset('companycoverphoto/cover.png')}}" style="width: 100%;height:300px">
            @else
            <img src="{{asset('companycoverphoto')}}/{{$company->cover_photo}}" style="width: 100%;height:300px">
            @endif

            <div class="col-lg-12"  style="overflow-x:auto;">
                <div class="p-4 mt-3 mb-1 bg-white">
                    <div class="row"  style="overflow-x:auto;">
                        <h3>About our company:</h3>
                        <hr>
                        <p>{!!$company->description!!}</p>
                    </div>
                </div>
                <table class="table table-bordered mt-5"  style="overflow-x:auto;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Slogan</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Website</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> @if(empty($company->logo))
                                        <img src="{{asset('companylogo/logos.png')}}" class="center " width="50" style="border-radius:50%">
                                        @else
                                        <img width="50" class="center " src="{{asset('companylogo')}}/{{$company->logo}}" style="border-radius:50%">
                                        @endif
                                    </td>
                                    <td>{{$company->slogan}}</td>
                                    <td>{{$company->address}}</td>
                                    <td>{{$company->phone}}</td>
                                    <td><a href="http://{{$company->website}}" target="blank">{{$company->website}}</a></td>
                                </tr>
                            </tbody>
                        </table>
                <div class="col-md-6 mx-auto text-center mb-5 section-heading">
                    <h2 class="mt-5 mb-2" style="font-family: cursive;">Job Posted</h2>
                </div>
                <table class="table" style="border: 1px solid black;">
                    <tbody>
                        @if(count($company->jobs)>0)
                        @foreach($company->jobs as $job)
                        <tr class="container">
                            <td>
                                @if(!empty(Auth::user()->company->logo))
                                <img src="{{asset('companylogo')}}/{{$job->company->logo}}" height="80" width="80" style="border-radius:50%">
                                @else
                                <img src="{{asset('companylogo/logo.jpg')}}" alt="Image" height="80" width="80" style="border-radius:50%">
                                @endif
                            </td>
                            <td><strong>Position:</strong>{{$job->position}}
                                <br>
                                <i class="badge badge-success mt-4" aria-hidden="true">&nbsp;{{$job->type}}</i>

                            </td>
                            <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<strong>Address:</strong>{{Illuminate\Support\Str::limit($job->address,15)}}</td>
                            <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<strong>Date:</strong>{{$job->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                    <button class="btn btn-success btn-sm"> Apply
                                    </button>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p style="color: red;" class="p-4 mt-4 bg-white text-center"> Sorry, There are not any job posted by this company!!</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection