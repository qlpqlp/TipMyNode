<?php
/**
*   File: Extra.php
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/
?>
    var LeafIcon = L.Icon.extend({
        options: {
           iconSize:     [38, 38]
        }
    });

    var dogeIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/yhellowDogeMiner.gif',
        iconSize:     [48, 38]
    });

    var dogeFoundationIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/foundation.gif'
    });

    var teslanIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/tesla.gif'
    });
    var spacexIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/spacex.gif',
        iconSize:     [58, 38]
    });

    var reddogeIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/redDogeMiner.gif',
        iconSize:     [68, 48]
    });
    var starlinkdogeIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/starlinkDogeMiner.gif',
        iconSize:     [48, 70]
    });

    var starshipIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/starship.png',
        iconSize:     [10, 58]
    });
    var superHeavyIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/super-heavy.png',
        iconSize:     [10, 58]
    });
    var starlinkIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/starlink.gif',
        iconSize:     [58, 50]
    });

    var dogeclarenIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/dogeclaren.gif',
        iconSize:     [68, 58]
    });

    var dogeDDPIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/ddp.gif',
        iconSize:     [60, 98]
    });

    var burnmanIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/burnman.gif',
        iconSize:     [30, 50]
    });

    var radiodogeIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/radiodoge.gif',
        iconSize:     [90, 90],
        className: 'radiodoge',
    });

    var radiodogeStationIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/radiodogeStation.gif',
        iconSize:     [60, 78]
    });

    var miningPoolDogeIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/miningPoolDoge.gif',
        iconSize:     [70, 50]
    });

    var interceptorIcon = new LeafIcon({
        iconUrl: '<?php echo $d->siteURL(); ?>/inc/markers/img/interceptor.gif',
        iconSize:     [30, 30]
    });


    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'For all <a href="https://dogecoin.com">Dogecoin</a> comunity!'
      }),

    latlng = L.latLng(0, 0);

    var map = L.map('map', {center: latlng, zoom: 2.5, minZoom: 0, layers: [tiles], });

    L.tileLayer('https://{s}-tiles.locationiq.com/v2/obk/r/{z}/{x}/{y}.png?key=<your_access_token>').addTo(map);
    L.control.geocoder('pk.eb97f8fd30942fee39ec36fe51583a2d').addTo(map);

    var markers = L.markerClusterGroup();

    for (var i = 0; i < addressPoints.length; i++) {
      var a = addressPoints[i];
      var title = a[2];
      if (a[3] == "dogeIcon"){
        var marker = L.marker(new L.LatLng(a[0], a[1]), { html: title, title: 'Pet me!', icon: dogeIcon });
      }else{
        var marker = L.marker(new L.LatLng(a[0], a[1]), { html: title, title: 'Pet me!', icon: starlinkdogeIcon });
      }

      marker.bindPopup(title);
      markers.addLayer(marker);
    }

 map.addLayer(markers);

 var theMarker = {};