<?php
/**
*   File: Default Configuration of TipMyNode
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/
    // uncomment this flag below to display erros if you want to debug
    // ini_set('display_errors', 1);

    // Add your Data Base credentials here!
    $config["dbhost"] = "localhost";  // put here you database adress
    $config["dbname"] = ""; // your DB name
    $config["dbuser"] = ""; // your DB username
    $config["dbpass"] = ""; // your DB password

    // Add your Dogecoin Core Node credentials here!
    $config["rpcuser"] = "";
    $config["rpcpassword"] = "";
    $config["dogecoinCoreServer"] = "http://";
    //$config["dogecoinCoreServerPort"] = 44555; //testnet
    $config["dogecoinCoreServerPort"] = 22555; //mainnet

    // an random hash to generate a IP Checksum
    $config["dbsalt"] = "add a random text here";

     // Your https://ipinfo.io/ Token to get GEO Coordenates from peers
    $config["ipinfoToken"] = "";

    // Here we define all Dogecoin Core Versions just to know the latest versions
    $config["DogeNodeVersions"] = array("1.14.5","1.14.6","1.21");

    // we get the root path of the files
    define('ROOTPATH', __DIR__);

    // include functions
    include("functions.php");

    // we include the TipMyNode version
    include("v.php");

?>