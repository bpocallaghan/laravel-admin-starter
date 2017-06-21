function initGoogleMap(selector, latitude, longitude, zoom_level)
{
    var mapCoords = new google.maps.LatLng(latitude, longitude);

    var mapOptions = {
        zoom: zoom_level,
        center: mapCoords,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    return new google.maps.Map(document.getElementById(selector), mapOptions);
}

function addGoogleMapsMarker(map, latitude, longitude, icon)
{
    var marker = new google.maps.Marker({
        map: map,
        icon: '/images/pins/' + icon + '.png',
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(latitude, longitude)
    });

    return marker;
}