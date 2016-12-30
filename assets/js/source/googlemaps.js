/**
 * Used to create a google map for the site (on the contact page).
 *
 * @global google
 *
 * @since VanDam 0.1.0
 *
 * @package VanDam
 * @subpackage Maps
 */
var VanDam_GoogleMaps;
(function ($) {

    var icons, iconURLPrefix, shadow;

    iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

    icons = [
        iconURLPrefix + 'red-dot.png',
        iconURLPrefix + 'green-dot.png',
        iconURLPrefix + 'blue-dot.png',
        iconURLPrefix + 'orange-dot.png',
        iconURLPrefix + 'purple-dot.png',
        iconURLPrefix + 'pink-dot.png',
        iconURLPrefix + 'yellow-dot.png'
    ];

    shadow = {
        anchor: new google.maps.Point(15, 33),
        url: iconURLPrefix + 'msmarker.shadow.png'
    };

    $(function () {
        var $map = $('#google-map'),
            _locations = $map.data('locations'),
            locations = [];

        for (var i = 0; i < _locations.length; i++) {

            var geo = new google.maps.Geocoder;

            geo.geocode({
                'address': _locations[i].address
            }, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {

                    var _geo = results[0].geometry.location,
                        location_obj = {
                            lat: _geo.lat(),
                            lng: _geo.lng()
                        };

                    locations.push(location_obj);

                    if (locations.length === _locations.length) {
                        VanDam_GoogleMaps.locations = locations;
                        VanDam_GoogleMaps.addMap(_locations);
                    }
                } else {
                    console.log('Geocode was not successfull because: ' + status);
                }
            });
        }
    });

    VanDam_GoogleMaps = {

        locations: [],

        _infowindow: {},

        _map: {},

        _markers: [],

        addMap: function (locations) {
            var _this = this;

            this._addNames(locations);
            this._createMapObject();
            this._setMarkers();
            this._autoCenter();

            $(window).resize(function () {
                _this._autoCenter();
            });
        },

        _addNames: function (locations) {
            for (var i = 0; i < this.locations.length; i++) {
                this.locations[i].name = locations[i].name;
                this.locations[i].address = locations[i].address;
            }
        },

        _createMapObject: function () {

            this._map = new google.maps.Map(document.getElementById('google-map'), {
                zoom: 10,
                center: new google.maps.LatLng(this.locations[0].lat, this.locations[0].lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                streetViewControl: false,
                panControl: false,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                }
            });

            this._infowindow = new google.maps.InfoWindow({
                maxWidth: 160
            });
        },

        _setMarkers: function () {

            var marker, iconCounter = 0;

            // Add the markers and infowindows to the map
            for (var i = 0; i < this.locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(this.locations[i].lat, this.locations[i].lng),
                    map: this._map,
                    icon: icons[iconCounter],
                    shadow: shadow
                });

                this._markers.push(marker);

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        VanDam_GoogleMaps._infowindow.setContent(
                            '<h2>' +
                            VanDam_GoogleMaps.locations[i].name +
                            '</h2>' +
                            '<p>' +
                            VanDam_GoogleMaps.locations[i].address +
                            '</p>'
                        );
                        VanDam_GoogleMaps._infowindow.open(VanDam_GoogleMaps._map, marker);
                    }
                })(marker, i));

                iconCounter++;

                // We only have a limited number of possible icon colors, so we may have to restart the counter
                if (iconCounter >= icons.length) {
                    iconCounter = 0;
                }
            }
        },

        _autoCenter: function () {

            //  Create a new viewpoint bound
            var bounds = new google.maps.LatLngBounds();

            //  Go through each...
            $.each(this._markers, function (index, marker) {
                bounds.extend(marker.position);
            });

            //  Fit these bounds to the map
            this._map.fitBounds(bounds);
        }
    };
})(jQuery);