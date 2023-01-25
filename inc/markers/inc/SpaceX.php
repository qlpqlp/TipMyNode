<?php
/**
*   File: SpaceX API
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/
?>
 var title = "Starbase - Cape Canaveral (Launch and Landing Control Center)"; theMarker = L.marker([28.48607108319623, -80.54294371048275], { title: title,icon: spacexIcon }).addTo(map).bindPopup(title);
 var title = "Starbase - Boca Chica (Launch Facility)"; theMarker = L.marker([25.99743317898298, -97.15730224801176], { title: title,icon: spacexIcon }).addTo(map).bindPopup(title);
 var title = "Starbase - California (Landing Zone 4)"; theMarker = L.marker([34.57660052071225, -120.63201179732054], { title: title,icon: spacexIcon }).addTo(map).bindPopup(title);

// SpaceX SpaceShip
 var title = "SpaceX - Starship"; theMarker = L.marker([29.997949801894695,-97.15717601361384], { title: title,icon: starshipIcon, class: "leaflet-marker-icon leaflet-zoom-animated leaflet-interactive xx" }).addTo(map).bindPopup(title);

<?php
/**
*   File: SpaceX API
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/

// Here we get all SpaceX Realtime Starlink Satellites Coordinates
$starlink = file_get_contents("https://api.spacexdata.com/v4/starlink");

// To easy access data we decode the JSON output
$starlink = json_decode($starlink);

// Because there are so many satellites we try to randomly show only a few
$show = rand(1,count($starlink));
//$show = 5000;

// initiate the count
$is = 0;

// Go tru all Satellites data
foreach ($starlink as $value) {
// There are some Satellites without coordinates, so we exclude that ones
    if ($value->latitude != ""){

        // We chek if the Random Satellite is the one to show
        if ($is == $show){

          // Now that we have cheked the Random Satellite, we generate anouther random because there are so many satellites we try to randomly show only a few
          $show = rand($is,count($starlink));

// Now we add the Marker to the Doge Nodes Map
?>
 var title = "<?php echo $value->spaceTrack->OBJECT_NAME; ?>"; theMarker = L.marker([<?php echo $value->latitude; ?>,<?php echo $value->longitude; ?>], { title: title,icon: starlinkIcon }).addTo(map).bindPopup(title);
<?php
};
        };
$is++;
};
?>