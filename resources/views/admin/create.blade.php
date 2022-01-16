@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
	<nav aria-label="breadcumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active " aria-current="page">Create Blogs</li>
		</ol>
	</nav>
	<div class="row justify-content-center">
		<div class="col-md-12">
			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
			@endif
			<form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">@csrf
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
					@if ($errors->has('title'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('title') }}</strong>
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
					<label>Image</label>
					<input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
					@if ($errors->has('image'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('image') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="1">Live</option>
						<option value="0">Draft</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Submit</button>
					<a type="button" href="/dashboard" class="btn btn-secondary ml-4">Back</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection