@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
	<nav aria-label="breadcumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active " aria-current="page">Create Testimonial</li>
		</ol>
	</nav>
	<div class="row justify-content-center">
		<div class="col-md-12">
			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
			@endif
			<form action="{{route('testimonial.store')}}" method="POST">@csrf
						
			<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" value="{{ old('name') }}"> 
							 @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
						</div>
						
						<div class="form-group">
							<label>Content</label>
							<textarea id="editors" name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ old('content') }}</textarea>
							 @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
						</div>

						<div class="form-group">
							<label>Profession</label>
								<input type="text" name="profession" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" value="{{ old('profession') }}"> 

							 @if ($errors->has('profession'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="form-group">
							<label>Viemo Video id</label>
							<input type="text" name="video_id" class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" value="{{ old('video_id') }}"> 

							 @if ($errors->has('video_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('video_id') }}</strong>
                                    </span>
                                @endif
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-success">Submit</button>
							<a type="button" href="/testimonial" class="btn btn-secondary ml-4">Back</a>
						</div>
					</form>
		</div>
	</div>
</div>
@endsection