<?php
/**
*   File: Index file of Tip My Node
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/
    // Now we include the basic configurations for TipMyNode Map
    include("inc/config.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tip My Node</title>
    <meta name="description" content="Want to recive Dogecoin Tips by running your Dogecoin Node?">
    <meta name="description" content="Coded with the love for all shibes!">
    <meta name="author" content="All Dogecoin Community!">
    <meta name="generator" content="You!">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Tip My Dogecoin Node">
    <meta name="twitter:site" content="<?php echo $d->siteURL(); ?>">
    <meta name="twitter:description" content="Want to recive Dogecoin Tips by running your Dogecoin Node?">
    <meta name="twitter:image" content="<?php echo $d->siteURL(); ?>/img/doge_tipmynode.png">
    <link href="<?php echo $d->siteURL(); ?>/img/TipMyNode.png" rel="icon">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" type="text/css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="//unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="js/leaflet.markercluster-src.js"></script>
    <link rel="stylesheet" href="https://maps.locationiq.com/v2/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.css">
    <script src="https://maps.locationiq.com/v2/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <link rel="stylesheet" href="css/doge.css" type="text/css" type="text/css">

<!--  We get all TipMyNode's -->
<?php include("inc/markers/inc/DogecoinNodes.php"); ?>
<!--  End of We get all TipMyNode's -->

<!-- Here we show a cool Doge Minner wen the page is loading -->
<script type="text/javascript">$(window).on('load', function() { $(".dogeload").fadeOut("slow"); });</script>
</head>
  <body style="overflow: hidden">
    <!-- This is the place to show the cool Doge Minner wen the page is loading -->
    <div class="dogeload"></div>
    <!-- This is the place to show the world map usinf OpenLayers and OpenStreetMap  -->
    <div id="map" class="map"></div>
    <!-- This is the javascript file that loads some of the Markers behaviors and also initialize the OpenLayers with OpenStreetMap  -->
<div id="search-box"></div>
<!-- To display the result -->
<div id="result"></div>
<!-- Modal -->
<div class="modal fade" id="TipMyNode" tabindex="-1" aria-labelledby="TipMyNodeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="TipMyNodeLabel">Tip My Node!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ratio ratio-16x9">
        <iframe width="100%" style="" src="<?php echo $d->siteURL(); ?>/inc/TipMyNode.php" title="Add your Node to be tip" frameborder="0"></iframe>
      </div>
    </div>
  </div>
</div>
<div class="row" style="position: absolute; bottom: 0px; margin: 0px; width: 100% !important">
    <div class="col">
      <a class="btn btn-primary" href="https://github.com/dogecoin/dogecoin/blob/master/doc/getting-started.md#starting-a-dogecoin-node" target="_blank">
        <i class="fa-solid fa-circle-nodes"></i> How to install and run a Dogecoin Node?
      </a>
    </div>
    <div class="col">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#TipMyNode">
        <i class="fa-solid fa-bone"></i> Add Your Node Doge Address
      </button>
    </div>
    <div class="col">
      <a class="btn btn-secondary" href="https://github.com/dogecoin/dogecoin/releases/" target="_blank">
        <i class="fa-solid fa-gauge-high"></i> Dogecoin Core Wallet latest Version <span class="badge text-bg-light">1.14.6</span>
      </a>
    </div>
    <div class="col">
      <button type="button" class="btn btn-warning">
        <i class="fa-solid fa-paw"></i> Much Tip My Nodes: <span class="badge text-bg-light"><?php echo count($pdo->query("SELECT * FROM tipmynode")->fetchAll()); ?></span>
      </button>
    </div>
    <div class="col">
      <a class="btn btn-primary" style="background-color: #5A34B8; border-color: #5A34B8" href="https://TipMySite.com">
        <i class="fa-solid fa-qrcode"></i> Go to Tip My Site
      </a>
    </div>
<script type="text/javascript">
// We include all map extra functions
<?php include("inc/markers/inc/Extra.php"); ?>

// We add some Dogecoin Mining Pools
<?php include("inc/markers/inc/DogecoinMiningPools.php"); ?>

// Dogecoin Foundation Location
<?php include("inc/markers/inc/DogecoinFoundation.php"); ?>

// Tesla Locations
<?php include("inc/markers/inc/Tesla.php"); ?>

// Interceptor, Ocean Cleanup
<?php include("inc/markers/inc/TheOceanCleanup.php"); ?>

// SpaceX, SpaceShip and Starlink Satelites Locations
<?php include("inc/markers/inc/SpaceX.php"); ?>
  </script>
</body>
</html>