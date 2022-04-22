
<style>
.feature-item {
  border-radius: 2px;
  height: 170px;
  width: 250px;
}

.card-1 {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}

.card-1:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  background-color:#2374e1;

}

</style>

      <div class="container">
          <div class="col-md-6 mx-auto text-center mb-5 section-heading">
            <h2 class="mb-5 mt-5" >Popular Categories</h2>
          </div>
        <div class="row">
          @foreach($categories as $category)
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4 rounded-top center" data-aos="fade-up" data-aos-delay="300">
            <a href="{{route('category.index',[$category->id])}}" class="card-1 feature-item" style=" border-radius: 15px;">
              <span class=" mb-3 text-primary"></span>
              <h2 class="font-weight-bold mt-4">{{$category->name}}</h2>
              <br>
              <span class="counting">{{$category->jobs->count()}}</span>
            </a>
          </div>
          @endforeach
          
        </div>

      </div>
