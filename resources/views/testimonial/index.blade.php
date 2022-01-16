@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active " aria-current="page">All Testimonial</li>
                </ol>
            </nav>
            <a type="submit" class="btn btn-primary mb-2 mt-2" href="/testimonial/create"><i class="fa fa-plus"></i>
          Add Testimonial
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
              <th scope="col">Content</th>
              <th scope="col">Name</th>
              <th scope="col">Profession</th>
              <th scope="col">Viemo id</th>
             

        </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $key=>$testimonial)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$testimonial->content}}</td>
              
             
              <td>{{$testimonial->name}}</td>
             

              <td>{{$testimonial->profession}}</td>
              <td>{{$testimonial->video_id}}</td>
            </tr>
            @endforeach
           
        </tbody>
        </table>
        {{$testimonials->links()}}
        </div>
    </div>
</div>
@endsection