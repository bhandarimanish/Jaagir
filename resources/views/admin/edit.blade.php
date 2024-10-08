@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
	<nav aria-label="breadcumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active " aria-current="page">Update Blog</li>
		</ol>
	</nav>
	<div class="row justify-content-center">
		<div class="col-md-12">
			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
			@endif
			<form action="{{route('post.update',[$post->id])}}" method="POST" enctype="multipart/form-data">@csrf
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"value="{{$post->title}}">
							  @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="form-group">
							<label>Content</label>
							<textarea name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ ($post->content) }}</textarea>
							 @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="form-group">
							<label>Image</label>
							<input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
							<br>
							Existing image:<img src="{{asset('blogimages')}}/{{$post->image}}" width="60"> 
							
							 @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="form-group">
							<label>Status</label>
							<select name="status" class="form-control">
								<option value="0"{{$post->status=='0'?'selected':''}}>Draft</option>
								<option value="1"{{$post->status=='1'?'selected':''}}>Live</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Update</button>
						</div>
					</form>
		</div>
	</div>
</div>
@endsection