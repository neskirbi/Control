<!DOCTYPE html>
<html lang="en">
<head>
    
  @include('administradores.header')
   
    <title>Mapa</title>
</head>
<body>
    <div id="map" style=" height: 150px; width:100%;"></div>
</body>

<script>
    
    
    
        
</script> 

<script>
  

    var markers = HtmltoJson('{{$marcadores}}');
    function initMap() {
      

      var myLatlng = { lat:  parseFloat('{{$lat}}'), lng: parseFloat('{{$lon}}') };
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: myLatlng,
      });


      var imagenmed = {
            url: '{{asset("images/iconos/maps/med.png")}}',
            // Este marcador tiene 20 pixeless de ancho por 32 pixeles de alto.
            scaledSize: new google.maps.Size(35, 50),
            // El origen para esta imagen es (0, 0).
            origin: new google.maps.Point(0, 0),
            // El ancla para esa imagen es la base del asta bandera en (0, 32).
            anchor: new google.maps.Point(0, 32)
        };

     
      var marker = new google.maps.Marker({
          position: myLatlng,
          title: 'Yo',
          icon: imagenmed,
          zIndex: 2
      });
      
      
      marker.setMap(map);

      
      for(var i=0;i< markers.length ; i++){

        
        var  myLatlng = { lat:  parseFloat(markers[i].lat), lng: parseFloat(markers[i].lon) };
        var image = {
          url: '{{asset("images/iconos/maps/hospital.png")}}',
          // Este marcador tiene 20 pixeless de ancho por 32 pixeles de alto.
          scaledSize: new google.maps.Size(80, 90),
          // El origen para esta imagen es (0, 0).
          origin: new google.maps.Point(0, 0),
          // El ancla para esa imagen es la base del asta bandera en (0, 32).
          anchor: new google.maps.Point(0, 32)
        };
        var marker = new google.maps.Marker({
            position: myLatlng,
            title: markers[i].obra,
            icon: image,
            zIndex: 1
        });

         // Create the initial InfoWindow.
        /*let infoWindow = new google.maps.InfoWindow({
          content:markers[i].obra,
          position: myLatlng,
        });
        
        infoWindow.open(map,marker);*/

        // To add the marker to the map, call setMap();

     
        marker.setMap(map);
      }
      
    }

    

    $( document ).ready(function() {
        //initMapa();
    });
   
</script>
@include('MapsApi')
</html>