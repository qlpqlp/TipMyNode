<?php
/**
*   File: DogeCoin Nodes
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/

?>
<!-- here we get all TipMyNode's -->
<script type="text/javascript">

var addressPoints = [
<?php

    // now we initialize some variables to count them
    $i = 0; $starlinknodes = 0;


    // we get all shibes that added their Doge Address on the TipMyNode
    $dbx = $pdo->query("SELECT * FROM tipmynode");
    while ($rowx = $dbx->fetch()) {

        $ip = ""; // we remove any IP Hash

        // Using the Doge Nodes Map DB we will find all nodes that have the Longitude and Latitude fields filled, to display them on the Map, but only the last 30 days nodes that where updated recently because of the offline nodes or dynamic IP's and compare the hash
        $db = $pdo->query("SELECT * FROM nodes where id = '".$rowx["id_node"]."' or subver LIKE '%".$rowx["node_hash"]."%' and lat !='' and lon !='' and date >= DATE(NOW()) - INTERVAL 30 DAY order by lat,lon");
        while ($row = $db->fetch()) {
            if ($ip != $row["ip"]){
              $ip = $row["ip"];
              // we add default icon
              $dogeIcon = "dogeIcon";
              // we create the QR Code and position on the map to be tip
              $tips = "<div class='row' style='min-width:200px'><div class='col-12' style='float:none;margin:auto; text-align: center'><div class='card card-primary card-outline'><div class='card-header' style='background-color: rgba(255, 204, 51, 1);'><h5 class='m-0'><b><i class='fa-solid fa-paw></i> Ð1</b></h5></div><div class='card-body' style='text-align: center'><img id='qrcode' src='//api.qrserver.com/v1/create-qr-code/?data=dogecoin:".$rowx['dogeaddress']."?amount=1&amp;size=400x400' alt='' title='Such QR Code!' class='card-img-top' style='max-width: 100%'/></div></div><div style='padding-top: 10px'><input onClick='this.select();' class='form-control' type='text' readonly='readonly' value='".$rowx['dogeaddress']."' /></div></div>";
              $validation = "<button type='button' class='btn btn-secondary' style='margin-bottom:10px'>TipMyNode</button>".$tips;
              echo '['.$row["lat"].', '.$row["lon"].', "'.$validation.'", "'.$dogeIcon.'"],';
              $i++;
           };
        };
    };

?>
]
</script>
<!-- End og here we get all TipMyNode's -->