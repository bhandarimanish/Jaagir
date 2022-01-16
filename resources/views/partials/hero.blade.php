<div style="height: 113px;"></div>

    <div class="site-blocks-cover overlay" style="background-image: url('external/images/test.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12" data-aos="fade">
            <h1>Find Job</h1>
            <form action="{{route('job.all')}}">
              <div class="row mb-3">
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <input type="text" name="search" class="mr-3 form-control zzborder-0 px-4" placeholder="job title, keywords, job type " required="">
                    </div>
                    <div class="col-md-6 mb-3 mb-md-0">
                      <div class="input-wrap">
                        <span class="icon icon-room"></span>
                      <input type="text" name="address" class="form-control form-control-block search-input  border-0 px-4" id="autocomplete" placeholder="address" onFocus="geolocate()" required="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <input type="submit" class="btn btn-search  btn-block" value="Search" style="background-color:#2374e1;color:white">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
            
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
