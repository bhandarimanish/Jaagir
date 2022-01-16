@extends('layouts.main')
@section('content')

<div class="container">
    <h2>Companies</h2>
    <div class="row">
        @foreach($companies as $company)
        <div class=" col-md-3 text-center">
            <div class="card justify-content-center" style="width: 18rem;">
                @if(empty($company->logo))
                <img src="{{asset('companylogo/logos.png')}}" class="center" style="width: 100px;height:100px;">
                @else
                <img width="100" class="center" src="{{asset('companylogo')}}/{{$company->logo}}" style="width: 100px;height:100px;">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center">{{Illuminate\Support\Str::limit($company->cname,20)}}</h5>
                <a href="{{route('company.index',[$company->id,$company->slug])}}" class="btn btn-primary">View Company</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <br><br><br>
    <div class="justify-content-center">
    {{$companies->links()}}
    </div>
</div>
@endsection