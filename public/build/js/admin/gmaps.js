$( document ).ready(function() {

        $('#address').blur(function(){
            // console.log($(this).val());
            var address = $(this).val();
            if (address) {
                getGeocoderFromAddress(address);
            } else {
                $('#latitude').attr('value','');
                $('#longitude').attr('value','');
            }
        });

        function getGeocoderFromAddress(address) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': address
            },
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    $('#latitude').attr('value',results[0].geometry.location.lat());
                    $('#longitude').attr('value',results[0].geometry.location.lng());
                    // console.log(results[0].geometry.location);
                    // showMapForLocation(results[0].geometry.location);
                }
            });
        }

        function showMapForLocation(myLocation) {
            $('#address div').append('<div id="map"></div>');
            $('#map').css({'margin-bottom':'10px','height':'300px','width':'auto'});
            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: myLocation,
                zoom: 15
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            new google.maps.Marker({
                position: myLocation,
                map: map
            });
        }

});