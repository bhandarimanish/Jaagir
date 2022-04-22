<div class="site-section block-15">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto text-center  section-heading bg-gradient-light text-dark">
        <h2 class="mb-5" style="font-family: Noto Sans, sans-serif;">Recent Blogs</h2>
      </div>
    </div>
    <div class="nonloop-block-15 owl-carousel">
      @if(count($posts)>0)
      @foreach($posts as $post)
      <div class="media-with-text">
        <div class="img-border-sm mb-3">
          <a href="{{route('post.show',[$post->id,$post->slug])}}" class="image-play">
            <img src="{{asset('blogimages')}}/{{$post->image}}" height="200" width="200" alt="" class="img-fluid">
        </div>
        <h2 class="heading mb-0 h5"><a href="{{route('post.show',[$post->id,$post->slug])}}">{{$post->title}}</a></h2>
        <span class="mb-3 d-block post-date"></a>{{$post->created_at->diffForHumans()}} &bullet; By <a href="#">Admin</a></span>
        <p>{{Illuminate\Support\Str::limit($post->content,50)}}</p>
        <p><a href="{{route('post.show',[$post->id,$post->slug])}}" class="btn btn-primary pill text-white px-4 center">Read More</a></p>
      </div>
      @endforeach
      @else
      <td  style="text-align:left"> Sorry,There are no any blogs to display!!</td>
      @endif
    </div>
    <div class="row">
    </div>
  </div>
</div>