//Funcion to insert the map
let marker;

function initMap() {
    // les coordonnées de Lievin
    let agence = {
        lat: 50.6363723,
        lng: 3.0612862
    };


    let content = "<h5>Agence Immo 2020</h5> <p>39 rue nationale</p><p>59000 Lille</p>";

    let affichePlace = document.querySelector("#map");

    let map = new google.maps.Map(affichePlace, {
        zoom: 13,
        center: agence
    });


    marker = new google.maps.Marker({
        position: agence,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
    });


    let infos = new google.maps.InfoWindow({
        content: content,
        position: agence,
        zIndex: 999999999,
        pixelOffset: new google.maps.Size(0, -60)
    });


    // let directionsService = new google.maps.DirectionsService();
    // let directionsDisplay = new google.maps.DirectionsRenderer({'map': map});
    // let distance = new google.maps.DistanceMatrixService;
    // let request = {
    //     origin: agence,
    //     destination: home,
    //     travelMode: google.maps.DirectionsTravelMode.DRIVING,
    //     unitSystem: google.maps.DirectionsUnitSystem.METRIC
    // };
    // directionsService.route(request, function (response, status) {
    //     if (status == google.maps.DirectionsStatus.OK) {
    //         directionsDisplay.setDirections(response);
    //         directionsDisplay.setOptions({'suppressMarkers': true});
    //         direct
    //     }
    // });

    marker.addListener("mouseover", () => {
        infos.open(map);
    });


    marker.addListener("mouseout", () => {
        infos.close(map);
    });


    marker.addListener('click', toggleBounce);

}

function toggleBounce() {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}



