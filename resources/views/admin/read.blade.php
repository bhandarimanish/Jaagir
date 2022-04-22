<style>
   .banner_image {
  background-image: url('/external/images/blog.jpg');
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
        <h4 style="color: white;"><a href="/" style="color: yellow;"> Home </a>/Update Profile</h4>
    </div>
</div>
   <div class="album text-muted">
     <div class="container">
       <div class="row" id="app">
          <div class=" mt-5 col-md-6 mx-auto text-center mb-5 section-heading">
            <h2 class="mb-3" style="font-family: cursive;">{{$post->title}}</h2>
          </div>
      <img src="{{asset('blogimages')}}/{{$post->image}}" class="mt-2" style="width: 100%;height:500px;">
          <div class="col-lg-12">
            <div class="p-4 mb-8 bg-white">
              <!-- icon-book mr-3-->
              <h5 class="h5 text-black mb-3">Created By:Admin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Created on:{{date('d-m-Y',strtotime($post->created_at))}}</h5>
              <p> {{$post->content}}.</p>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
            </div>
          </div>
     </div>
   </div>
@endsection
