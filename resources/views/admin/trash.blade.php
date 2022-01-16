@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active " aria-current="page">All Blog Trash</li>
                </ol>
            </nav>
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
            @if(Session::has('messages'))
            <div class="alert alert-danger">
                {{Session::get('messages')}}
            </div>
            @endif
            <table class="table table-striped">
        <thead>
        <tr>
              <th scope="col">Image</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th>Date</th>
              <th scope="col">Action</th>

        </tr>
        </thead>
        <tbody>
        @if(count($posts)>0)
            @foreach($posts as $post)
            <tr>
            <td><img src="{{asset('blogimages')}}/{{$post->image}}" width="80"></td>
              <td>{{$post->title}}</td>
              <td>{{Illuminate\Support\Str::limit($post->content,20)}}</td>
              <td>{{$post->created_at->diffForHumans()}}</td>
              <td>
                  <a href="{{route('post.restore',[$post->id])}}"><button class="btn btn-success">Restore</button></a>

              </td>
            </tr>
            @endforeach
            @else
            <td colspan="9" class="text-center" style="color:red">No blog trash to display</td>

            @endif
           
        </tbody>
        </table>
        {{$posts->links()}}
        </div>
    </div>
</div>
@endsection