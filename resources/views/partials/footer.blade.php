<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h3 class="footer-heading mb-4 text-white">About</h3>
        <p>Jaagir aims to make aspiring individuals to find the right and perfect jobs they are dreaming of.</p>
        <p class="collapse" id="collapseExample">
        It also helps employers to find the right candidate for the tasks they want to assign and help their organization grow
        </p>
        <p><a href="#main" class="btn btn-primary pill text-white px-4 hide-me" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Read More</a></p>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <h3 class="footer-heading mb-4 text-white">Quick Menu</h3>
            <ul class="list-unstyled">
              <li><a href="/register">For Seeker</a></li>
              <li><a href="{{route('employer.register')}}">For Employeer</a></li>
              <li><a href="{{route('company')}}">Company</a></li>
            </ul>
          </div>
          <div class="col-md-6">
            <h3 class="footer-heading mb-4 text-white">Categories</h3>
            <?php $categories = App\Category::take(4)->get(); ?>
            @foreach($categories as $category)
            <ul class="list-unstyled">
              <li><a href="{{route('category.index',[$category->id])}}">{{$category->name}}</a></li>
            </ul>
            @endforeach
          </div>
        </div>
      </div>


      <div class="col-md-2">
        <div class="col-md-12">
          <h3 class="footer-heading mb-4 text-white">Social Icons</h3>
        </div>
        <div class="col-md-12">
          <p>
            <a href="https://www.facebook.com/" class="pb-2 pr-2 pl-0" target="blank"><span class="icon-facebook"></span></a>
            <a href="https://www.twitter.com/" class="p-2" target="blank"><span class="icon-twitter"></span></a>
            <a href="https://www.instagram.com/" class="p-2" target="blank"><span class="icon-instagram"></span></a>
            <a href="https://www.vimeo.com/" class="p-2" target="blank"><span class="icon-vimeo"></span></a>

          </p>
        </div>
      </div>
    </div>
    <div class="row  mt-5 text-center">
      <div class="col-md-12">
        <p>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
          <script>
            document.write(new Date().getFullYear());
          </script> All Rights Reserved | This website belongs to Jaagir <i class="icon-heart text-warning" aria-hidden="true"></i>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
      </div>

    </div>
  </div>
</footer>
</div>

<script src="{{asset('external/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('external/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('external/js/jquery-ui.js')}}"></script>
<script src="{{asset('external/js/popper.min.js')}}"></script>
<script src="{{asset('external/js/bootstrap.min.js')}}"></script>
<script src="{{asset('external/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('external/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('external/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('external/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('external/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('external/js/aos.js')}}"></script>


<script src="{{asset('external/js/mediaelement-and-player.min.js')}}"></script>

<script src="{{asset('external/js/main.js')}}"></script>
<script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $(function() {
    $("#datepicker").datepicker();
  });
</script>

<style>
  .hide-me[aria-expanded="true"] {display: none;}
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var mediaElements = document.querySelectorAll('video, audio'),
      total = mediaElements.length;

    for (var i = 0; i < total; i++) {
      new MediaElementPlayer(mediaElements[i], {
        pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
        shimScriptAccess: 'always',
        success: function() {
          var target = document.body.querySelectorAll('.player'),
            targetTotal = target.length;
          for (var j = 0; j < targetTotal; j++) {
            target[j].style.visibility = 'visible';
          }
        }
      });
    }
  });
</script>


<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */
      (document.getElementById('autocomplete')), {
        types: ['geocode']
      });

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDB_oEbgMp7Yt7G4VaWahhWFek1nBT80n4"></script>