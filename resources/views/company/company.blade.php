<style>
   .banner_image {
  background-image: url('external/images/company.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Company</h4>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5 mx-auto text-center mb-5 section-heading">
            <h2 style="font-family: cursive;">Companies</h2>
        </div>
    </div>
    <div class="row">
        @foreach($companies as $company)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5 justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="card feature-item" style="background-color:#f2f7ff;">
                @if(empty($company->logo))
                <img src="{{asset('companylogo/logos.png')}}" class="center" style="width: 100px;height:100px; border-radius: 50%;">
                @else
                <img width="100" class="center" src="{{asset('companylogo')}}/{{$company->logo}}" style="width: 100px;height:100px; border-radius: 50%;">
                @endif
                <h5 class=" mt-2 card-title text-center">{{Illuminate\Support\Str::limit($company->cname,15)}}</h5>
                <a href="{{route('company.index',[$company->id,$company->slug])}}" class="btn btn-primary">View Company</a>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection