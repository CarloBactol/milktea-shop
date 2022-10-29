<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<style>
  #googleMap {
    height: 400px;
    width: 600px;
  }
</style>

<body>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiLMZ3-Tmq-6e0e8CZfXePdNEWyTC9OlY&libraries=places">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <div class="jumbotron">
    <div class="container-fluid">
      <h4>Calculate Your Travelling Distances.</h4>
      <form class="form-horizontal">
        <div class="form-group">
          <label for="from" class="col-sm-2 control-label"><i class="far fa-dot-circle"></i></label>
          <div class="col-xs-4">
            <input type="text" id="from" placeholder="Your City Location" class="form-control" onchange="calcRoute();">
          </div>
        </div>
        <div class="form-group">

          <label for="to" class="col-xs-2 control-label"><i class="fas fa-map-marker-alt"></i></label>
          <div class="col-xs-4">
            <input type="text" id="to" class="form-control" value="Talusan, Zamboanga Sibugay, Philippines">
          </div>

        </div>

      </form>

      <div class="col-xs-offset-2 col-xs-10 mt-2">
        <button class="btn btn-info btn-lg "><i class="fas fa-map-signs"></i> Submit</button>
      </div>
    </div>
    <div class="container-fluid">
      <div id="googleMap">

      </div>
      <div id="output">

      </div>
    </div>

  </div>

  <script>
    //set map options
    var myLatLng = { lat: 11.112666, lng: 122.509476 };
    var mapOptions = {
        center: myLatLng,
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    
    };
    
    //create map
    var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
    
    //create a DirectionsService object to use the route method and get a result for our request
    var directionsService = new google.maps.DirectionsService();
    
    //create a DirectionsRenderer object which we will use to display the route
    var directionsDisplay = new google.maps.DirectionsRenderer();
    
    //bind the DirectionsRenderer to the map
    directionsDisplay.setMap(map);
    
    
    //define calcRoute function
    function calcRoute() {
        //create request
        var request = {
            origin: document.getElementById("from").value,
            destination: document.getElementById("to").value,
            travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
            unitSystem: google.maps.UnitSystem.IMPERIAL
        }
    
        //pass the request to the route method
        directionsService.route(request, function (result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
    
                //Get distance and time
                const output = document.querySelector('#output');
                output.innerHTML = "<div class='alert-info'>From: " + document.getElementById("from").value + ".<br />To: " + document.getElementById("to").value + ".<br /> Driving distance <i class='fas fa-road'></i> : " + result.routes[0].legs[0].distance.text + ".<br />Duration <i class='fas fa-hourglass-start'></i> : " + result.routes[0].legs[0].duration.text + ".</div>";
    
                //display route
                directionsDisplay.setDirections(result);
            } else {
                //delete route from map
                directionsDisplay.setDirections({ routes: [] });
                //center map in London
                map.setCenter(myLatLng);
    
                //show error message
                output.innerHTML = "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Could not retrieve driving distance.</div>";
            }
        });
    
    }
    
    
    
    //create autocomplete objects for all inputs
    var options = {
        types: ['(cities)']
    }
    
    var input1 = document.getElementById("from");
    var autocomplete1 = new google.maps.places.Autocomplete(input1, options);
    
    var input2 = document.getElementById("to");
    var autocomplete2 = new google.maps.places.Autocomplete(input2, options);
  </script>
</body>

</html>