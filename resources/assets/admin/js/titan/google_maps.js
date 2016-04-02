function initGoogleMapView(selector, latitude, longitude, zoom_level)
{
    var mapCoords = new google.maps.LatLng(latitude, longitude);

    var mapOptions = {
        zoom: zoom_level,
        center: mapCoords,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
        },
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [
            {
                featureType: "administrative",
                elementType: "all",
                stylers: [{visibility: "on"}, {saturation: -100}, {lightness: 20}]
            }, {
                featureType: "road",
                elementType: "all",
                stylers: [{visibility: "on"}, {saturation: -100}, {lightness: 40}]
            }, {
                featureType: "water",
                elementType: "all",
                stylers: [{visibility: "on"}, {saturation: -10}, {lightness: 30}]
            }, {
                featureType: "landscape.man_made",
                elementType: "all",
                stylers: [{visibility: "simplified"}, {saturation: -60}, {lightness: 10}]
            }, {
                featureType: "landscape.natural",
                elementType: "all",
                stylers: [{visibility: "simplified"}, {saturation: -60}, {lightness: 60}]
            }, {
                featureType: "poi",
                elementType: "all",
                stylers: [{visibility: "off"}, {saturation: -100}, {lightness: 60}]
            }, {featureType: "transit", elementType: "all", stylers: [{visibility: "off"}, {saturation: -100}, {lightness: 60}]}
        ]
    };

    var map = new google.maps.Map(document.getElementById(selector), mapOptions);

    return map;
}

function addGoogleMapMarker(map, latitude, longitude, draggable)
{
    draggable = (draggable == undefined || draggable == false ? false : true);

    var marker = new google.maps.Marker({
        map: map,
        draggable: draggable,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(latitude, longitude)
    });

    return marker;
}

function initGoogleMapEditClean(selector, latitude, longitude, zoom_level)
{
    $('form input[name="zoom_level"]').val(zoom_level);
    $('form input[name="latitude"]').val(latitude);
    $('form input[name="longitude"]').val(longitude);

    var map = initGoogleMapView(selector, latitude, longitude, zoom_level);

    google.maps.event.addListener(map, 'zoom_changed', function ()
    {
        $('form input[name="zoom_level"]').val(map.getZoom());
    });

    google.maps.event.addListener(map, 'center_changed', function ()
    {
        var pos = map.getCenter();

        $('form input[name="latitude"]').val(pos.lat());
        $('form input[name="longitude"]').val(pos.lng());
    });

    return map;
}

function initGoogleMapEditMarker(selector, latitude, longitude, zoom_level)
{
    $('form input[name="zoom_level"]').val(zoom_level);
    $('form input[name="latitude"]').val(latitude);
    $('form input[name="longitude"]').val(longitude);

    var map = initGoogleMapView(selector, latitude, longitude, zoom_level);
    var marker = addGoogleMapMarker(map, latitude, longitude, true);

    google.maps.event.addListener(map, 'zoom_changed', function ()
    {
        $('form input[name="zoom_level"]').val(map.getZoom());
    });

    google.maps.event.addListener(marker, 'mouseup', function ()
    {
        var pos = marker.getPosition();
        $('form input[name="latitude"]').val(pos.lat());
        $('form input[name="longitude"]').val(pos.lng());
    });

    // https://developers.google.com/maps/documentation/javascript/examples/places-searchbox
    var input = (document.getElementById('pac-input'));
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var searchBox = new google.maps.places.SearchBox((input));

    google.maps.event.addListener(searchBox, 'places_changed', function ()
    {
        var places = searchBox.getPlaces();

        if (places.length == 0)
        {
            return;
        }

        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, place; place = places[i]; i++)
        {
            marker.setPosition(place.geometry.location);
            map.setCenter(place.geometry.location);

            google.maps.event.trigger(marker, 'mouseup');

            //$("#location option:contains(" + place.address_components[1].long_name + ")").attr('selected', 'selected');
        }
    });

    return {map: map, marker: marker};
}

function addGoogleMapMarkerClick(map, title, latitude, longitude, content)
{
    var marker = new google.maps.Marker({
        map: map,
        title: title,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(latitude, longitude)
    });

    google.maps.event.addListener(marker, 'click', function ()
    {
        var iw = new google.maps.InfoWindow({content: content});
        iw.open(map, marker);
    });

    return marker;
}