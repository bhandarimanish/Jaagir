@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active " aria-current="page">All Blogs</li>
                </ol>
            </nav>
            <a type="submit" class="btn btn-primary mb-2 mt-2" href="/dashboard/create"><i class="fa fa-plus"></i>
          Add Blogs
        </a>
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
        <th scope="col">SN</th>
              <th scope="col">Image</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Satus</th>
              <th>Date</th>
              <th scope="col">Action</th>

        </tr>
        </thead>
        <tbody>
        @if(count($posts)>0)
            @foreach($posts as $key=>$post)
            <tr>
              <td>{{$key+1}}</td>
              <td><img src="{{asset('blogimages')}}/{{$post->image}}" width="80"></td>
              <td><a href="{{route('post.show',[$post->id,$post->slug])}}" target="_blank" >{{$post->title}}</a></td>
              <td>{{Illuminate\Support\Str::limit($post->content,20)}}</td>
              <td>
                @if($post->status=='0')
                   <a href="{{route('post.toggle',[$post->id])}}" class="badge badge-primary"> Draft</a>
                    @else
                   <a href="{{route('post.toggle',[$post->id])}}" class="badge badge-success"> Live</a>
                @endif
            </td>
              <td>{{$post->created_at->format('Y/m/d')}}</td>
              <td>
                  <a href="{{route('post.edit',[$post->id])}}"><i class="fa fa-edit fa-sm"></i></a>


                    <!-- Button trigger modal -->
<button type="button" data-toggle="modal" data-target="#exampleModal{{$post->id}}" style="border: none;background-color:white">
<i class="nav-icon fa fa-trash fa-sm" style="color: red;"> </i></a>
</button>

<!-- Modal -->
        <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Do you want to delete?
          </div>
          <form action="{{route('post.delete')}}" method="POST">@csrf
          <div class="modal-footer">
            <input type="hidden" name="id" value="{{$post->id}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">delete</button>
          </div>
      </form>
        </div>
        </div>
        </div>
              </td>
            </tr>
            @endforeach
            @else
                    <td colspan="6" style="background-color: white; color:red;text-align:center">No Blogs to display</td>

                    @endif
        </tbody>
        </table>
        {{$posts->links()}}
        </div>
    </div>
</div>
@endsection