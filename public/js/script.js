/*jslint browser:true node:true */
/*global $*/
/*global canvas*/
/*jslint newcap: true */
/*global getComputedStyle*/
/*global document, window*/
var geocoder;
var adresse;
var lieu;
var position;
var map;
var findPlace;
window.onload = function () {
      geocoder = new google.maps.Geocoder();
      adresse = document.getElementById('adresse').value;
      lieu = document.getElementById('lieu').value;
      geocoder.geocode({'address': adresse+", france" , region: '33'}, function (response, status) {
            position = new google.maps.LatLng(response[0].geometry.location.lat(), response[0].geometry.location.lng());
             map = new google.maps.Map(document.getElementById('map-canvas'), {center: position, zoom: 15});
            findPlace = new google.maps.places.PlacesService(map);
            console.log(lieu);
            findPlace.textSearch({query: lieu}, function (result, status) {
                  var location = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());
                  map.setCenter(location);
            })
      });
}