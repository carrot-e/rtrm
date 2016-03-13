var mapStyle = [
    {
        "elementType": "geometry",
        "stylers": [{"hue": "#dd983f"}, {"saturation": -68}, {"lightness": -4}, {"gamma": 0.72}]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [{"visibility": "off"}]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [{"hue": "#57a670"}, {"gamma": 3.1}]
    },
    {
        "featureType": "water",
        "stylers": [{"hue": "#196870"}, {"gamma": 0.44}, {"saturation": -33}]
    },
    {
        "featureType": "poi.park",
        "stylers": [{"hue": "#57a670"}, {"saturation": -23}]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [{"hue": "#007fff"}, {"gamma": 0.77}, {"saturation": 65}, {"lightness": 99}]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [{"gamma": 0.11}, {"weight": 5.6}, {"saturation": 99}, {"hue": "#196870"}, {"lightness": -86}]
    },
    {
        "featureType": "transit.line",
        "elementType": "geometry",
        "stylers": [{"lightness": -48}, {"hue": "#241f19"}, {"gamma": 1.2}, {"saturation": -23}]
    },
    {
        "featureType": "transit",
        "elementType": "labels.text.stroke",
        "stylers": [{"saturation": -64}, {"hue": "#ff9100"}, {"lightness": 16}, {"gamma": 0.47}, {"weight": 2.7}]
    }
];

app.directive('gmap', function($location, $compile, Data) {
    // directive link function
    var link = function(scope, element, attrs) {
        var map, infoWindow, polyline;
        scope.markers = [];

        if (attrs.mapId) {
            scope.mapId = attrs.mapId;
            Data.getMap(attrs.mapId).success(initMap);
        } else {
            initMap({center: '0,0', zoom: 2});
        }

        // set map height
        var mapHeight = Math.max(angular.element('body').height() - (angular.element('.container').height()
            + angular.element('.navbar').height()), 600);
        angular.element(element).css({'height': mapHeight + 'px'});
        angular.element('#story').css({'height': mapHeight + 'px'});

        /**
         * map initialization
         * gets the map and map points (if any)
         *
         * @param mapData {center, zoom}
         */
        function initMap(mapData) {
            scope.map = mapData;
            // map config
            var latLng = mapData.center.split(',');
            var mapOptions = {
                center: new google.maps.LatLng(latLng[0], latLng[1]),
                zoom: mapData.zoom,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: true,
                styles: mapStyle
            };

            if (typeof map === 'undefined') {
                map = new google.maps.Map(element[0], mapOptions);
            }

            initListeners();

            if (attrs.mapId) {
                Data.getPointsByMap(attrs.mapId).success(drawMarkers);
            }
        }

        /**
         * map events listeners initialization
         */
        function initListeners() {
            if (scope.isEdit) {
                map.addListener('click', addMark);
                map.addListener('zoom_changed', saveMap);
                map.addListener('dragend', saveMap);
            }
        }

        /**
         * adds markers (from user input)
         *
         * @param e {Event}
         */
        function addMark(e) {
            if (typeof infoWindow !== 'undefined' && infoWindow.map !== null) {
                return;
            }
            var marker = drawMarker(map, e.latLng);
            savePoint({coordinates: e.latLng, description: ''}, marker);
        }

        /**
         * saves current state of map:
         * zoom, center, title, description
         */
        function saveMap() {
            var currentMapData = {
                id: attrs.mapId,
                center: map.getCenter(),
                zoom: map.getZoom(),
                title: scope.map.title,
                photo: scope.map.photo,
                description: scope.map.description
            };

            Data.storeMap(currentMapData).success(onMapStored);
        }

        /**
         * handler called after map is stored
         * (need to update the page location right after the store)
         *
         * @param response
         */
        function onMapStored(response) {
            if (response) {
                if (!attrs.mapId) {
                    var newPath;
                    attrs.mapId = response;
                    if ($location.path().endsWith('/')) {
                        newPath = $location.path() + response;
                    } else {
                        newPath = $location.path() + '/' + response
                    }
                    $location.path(newPath).replace();
                }
            }
        }

        /**
         * paints markers on the map
         *
         * @param data
         */
        function drawMarkers(data) {
            var i = 0,
                numberOfMarkers = data.length,
                latLng = [];
            scope.points = data;

            for (i; i < numberOfMarkers; i++) {
                latLng = data[i].coordinates.split(',');
                var marker = drawMarker(map,
                          new google.maps.LatLng(latLng[0], latLng[1]), data[i].id,
                          data[i].description);
                scope.markers.push(marker);
            }

            drawPolyline();
        }

        /**
         * builds polyline according to current scope.markers array
         *
         */
        function drawPolyline() {
            if (polyline) {
                polyline.setMap(null);
                polyline = null;
            }

            polyline = new google.maps.Polyline({
                strokeColor: '#FFB000',
                strokeOpacity: 1.0,
                strokeWeight: 5
            });
            polyline.setMap(map);

            var path = [];

            for (var i = 0; i < scope.markers.length; i++) {
                path.push(scope.markers[i].position);
            }
            polyline.setPath(path);
        }

        /**
         * paints single marker on the map
         *
         * @param map
         * @param position
         * @param id
         * @param content
         * @returns {google.maps.Marker|*}
         */
        function drawMarker(map, position, id, content) {
            var marker;
            var markerOptions = {
                position: position,
                map: map,
                draggable: scope.isEdit ? true : false
                //icon: '/app/images/map.svg'
            };

            marker = new google.maps.Marker(markerOptions);
            marker.pointId = id;
            if (marker.pointId) {
                initMarkerPopup(marker);
            }


            google.maps.event.addListener(marker, 'dragend', function(e) {
                savePoint({coordinates: e.latLng, id: marker.pointId}, marker);
            });

            return marker;
        }

        /**
         * add click listener to marker
         * @param marker
         */
        function initMarkerPopup(marker) {
            var maxInfoboxSize = 0.75;
            google.maps.event.addListener(marker, 'click', function () {
                // close window if not undefined
                if (typeof infoWindow !== 'undefined') {
                    infoWindow.close();
                }

                // in view mode -- no need to create InfoWindow
                if (!scope.isEdit) {
                    return;
                }

                map.panTo(marker.getPosition());

                // create new window
                var maxWidth = Math.floor(map.getDiv().offsetWidth * maxInfoboxSize);
                var infoWindowOptions = {
                    content: '<div id="directive-container-' + marker.pointId + '"></div>',
                    maxWidth: maxWidth
                };
                infoWindow = new google.maps.InfoWindow(infoWindowOptions);

                google.maps.event.addListener(infoWindow, 'domready', function() {
                    var container = angular.element('#directive-container-' + marker.pointId);
                    if (scope.isEdit) {
                        container.append($compile('<edit-point point-id=' + marker.pointId + ' width="' + (maxWidth - 100) + '"></edit-point>')(scope));
                    } else {
                        container.append($compile('<view-point point-id=' + marker.pointId + '></view-point>')(scope));
                    }
                });

                infoWindow.open(map, marker);
            });
        }

        /**
         * saves a point to db
         *
         * @param data
         * @param marker
         */
        function savePoint(data, marker) {
            var coordinates = data.coordinates.lat() + ',' + data.coordinates.lng();
            data.mapId = attrs.mapId;
            data.coordinates = coordinates;
            data.order = 1; // this is not used so far
            Data.storePoint(data).success(function(response) {
                marker.pointId = response;
                initMarkerPopup(marker);
                google.maps.event.trigger(marker, 'click');

                if (!data.id) {
                    scope.markers.push(marker);
                }

                drawPolyline();
            });

            saveMap();
        }

        /**
         * UI: saves point details
         * @param point
         */
        scope.savePointDetails = function savePointDetails(point) {
            Data.storePoint({id: point.id, description: point.description});
            infoWindow.close();
        };

        /**
         * UI: pans to point
         * @param pointId
         */
        scope.panToPoint = function panToPoint(pointId) {
            for (var i = 0; i < scope.markers.length; i++) {
                if (scope.markers[i].pointId == pointId) {
                    map.panTo(scope.markers[i].position);
                    map.setZoom(scope.map.zoom + 1);
                    break;
                }
            }
        }

        /**
         * UI: deletes marker
         * @param pointId
         */
        scope.deleteMarker = function deleteMarker(pointId) {
            Data.deletePoint(pointId).success(function() {
                for (var i = 0; i < scope.markers.length; i++) {
                    if (scope.markers[i].pointId == pointId) {
                        var deletedMarker = scope.markers.splice(i, 1);
                        deletedMarker[0].setMap(null);
                        break;
                    }
                }
                drawPolyline();
            });
        }
    };

    return {
        restrict: 'E',
        template: '<div id="gmap"></div>',
        replace: true,
        link: link
    };
});

