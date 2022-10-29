<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>


  <div class="wrapper">
    <div id="warpper">
      <input type="text" id="location">
    </div>
    <div id="map" style="width:100%; min-height:40rem">

    </div>

  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiLMZ3-Tmq-6e0e8CZfXePdNEWyTC9OlY&libraries=places">
  </script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function(){
      var auto;
      var location = 'location';
      auto = new google.maps.places.Autocomplete((document.getElementById(location)), {
        types: ['geocode'],
      });
    });

    function showMap(lat, lon){
      var coor = {lat: lat, lon:lon}

      new google.maps.Map(
        document.getElementById('map'){
          zoom: 10,
          center: coor,
        }
      );
    }

    showMap(0,0)
  </script>
</body>

</html>