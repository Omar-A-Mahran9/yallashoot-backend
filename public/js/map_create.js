var geocoder;
var googleMap;

function myMap() {

    myLatlng = { lat: lat, lng: lng };

    var mapProp= {
        center:myLatlng,
        zoom:12,
    };


    googleMap = new google.maps.Map(document.getElementById("googleMap"),mapProp);


    marker = new google.maps.Marker({
        position:mapProp.center,
        animation:google.maps.Animation.BOUNCE
    });

    marker.setMap(googleMap);


    geocoder = new google.maps.Geocoder();


    marker.addListener("click", () => {
        googleMap.setZoom(8);
        googleMap.setCenter(marker.getPosition());

    });




    googleMap.addListener("click", (mapsMouseEvent) => {
        let clickAddress = mapsMouseEvent.latLng.toJSON();
        marker.setPosition(clickAddress);



        geocoder.geocode( {'location': marker.getPosition()}, function(results, status) {
            if (status == 'OK') {
                $("#address").html(results[0].formatted_address);
                $("#addressInput").val(results[0].formatted_address);
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });


        $('#lat_inp').val(clickAddress.lat);
        $('#lng_inp').val(clickAddress.lng);

    });

}


function getCurrentPos()
{
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            marker.setPosition(pos);
            geocoder.geocode( {'location': marker.getPosition()}, function(results, status) {
                if (status == 'OK') {
                    $('#lat_inp').val(marker.getPosition().lat());
                    $('#lng_inp').val(marker.getPosition().lng());
                    $("#address").val(results[0].formatted_address);
                    googleMap.setZoom(8);
                    googleMap.setCenter(marker.getPosition());
                } else {
                    console.log('Geocode was not successful for the following reason: ' + status);
                }
            });
        });
    }
}
