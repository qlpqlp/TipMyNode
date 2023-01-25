<?php
/**
*   File: Functions used on the Doge Nodes Map
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/

    // if check if the config file is loaded
    If (!defined('ROOTPATH')){
        exit();
     };

    // if cron is runnin we connect to the Dogecon Core Node
    If (isset($cron)){
        require_once ROOTPATH.'/vendors/dogecoinRPCBridge.php';
        $DogePHPbridgeCommand = new DogecoinRpc($config["rpcuser"], $config["rpcpassword"], $config["dogecoinCoreServer"], $config["dogecoinCoreServerPort"]);
    };

    // Add the PDO DB Connection
    $db = 'mysql:host='.$config["dbhost"].';dbname='.$config["dbname"];
    $opt = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
    try {
      $pdo = new PDO($db, $config["dbuser"], $config["dbpass"], $opt);
      }
    catch (PDOException $e) {
      if(isset($config["rpcuser"]) and $config["rpcuser"] != "" ){ /*echo '<br>DB Error: ' . $e->getMessage() . '<br><br>';*/ echo 'Error'; header("Refresh:5"); exit();};
     };



// class DogeBridge to be able to interact beetwin DB and Dogecoin Core RCP
class DogeBridge {

    private $pdo;     // include PDO connections
    private $config;     // include the configurations
    public function __construct($pdo,$config) {
        $this->pdo = $pdo;
        $this->config = $config;
    }

  // update an existent peer
  public function UpdateNode($ip,$version,$subver)
    {
      $ip_hash = hash('sha256', $ip.$this->$config["dbsalt"]); // we do not store the IP, insted we create a checksum of the IP for privacy protection
      $db = $this->pdo->query("UPDATE nodes SET
      version = '".$version."',
      subver = '".$subver."',
      date = '".date('Y-m-d H:i:s')."'
      WHERE ip = '".$ip_hash."' limit 1");

      return null;
    }

  // add a new peer
  public function AddNode($ip,$version,$subver)
    {
      $ip_hash = hash('sha256', $ip.$this->$config["dbsalt"]); // we do not store the IP, insted we create a checksum of the IP for privacy protection
      $db = $this->pdo->query("INSERT INTO `nodes` (
      `ip`,
      `version`,
      `subver`,
      `date`
      ) VALUES (
      '$ip_hash',
      '$version',
      '$subver',
      '".date('Y-m-d H:i:s')."'
      );");

      // update the GEO corrdinates on the peer added
      $this->GeoNode($ip);

        return null;
    }

   //find a peer
  public function FindNode($ip)
    {
      $ip_hash = hash('sha256', $ip.$this->$config["dbsalt"]); // we do not store the IP, insted we create a checksum of the IP for privacy protection
      $db = $this->pdo->query("SELECT * FROM nodes where ip='".$ip_hash."' limit 1");
      if ($db->fetch()){
              return 1;
      };
      return false;
    }

  //add/update GEO location
  public function GeoNode($ip)
    {

      $pos = strpos($ip, ']:');
      if ($pos !== false) {
        $ippre = explode("]:",$ip);
        $ippre[0] = str_replace("[", "", $ippre[0]);
      }else{
          $ippre = explode(":",$ip);
      };
      $details = str_replace("'", "", file_get_contents("http://ipinfo.io/".$ippre[0]."?token=".$this->$config["ipinfoToken"]));
      $details = json_decode($details);
      $geo = explode(",",$details->loc);
      if (isset($details->country)){ // make sure ipinfo.io is working
        $ip_hash = hash('sha256', $ip.$this->$config["dbsalt"]); // we do not store the IP, insted we create a checksum of the IP for privacy protection
        $db = $this->pdo->query("UPDATE nodes SET
        lat = '".$geo[0]."',
        lon = '".$geo[1]."',
        country = '".filter_var($details->country, FILTER_SANITIZE_STRING)."',
        city = '".filter_var($details->city, FILTER_SANITIZE_STRING)."',
        ipinfo = '".filter_var($details->org, FILTER_SANITIZE_STRING)."'
        WHERE ip = '".$ip_hash."' and lat = '' and lon = '' limit 1");
      };
      return null;
  }

  // add TipMyNode
  public function AddTipMyNode($dogeaddress,$node_hash)
    {
      $db = $this->pdo->query("INSERT INTO `tipmynode` (
      `dogeaddress`,
      `node_hash`
      ) VALUES (
      '$dogeaddress',
      '$node_hash'
      );");

        return null;
    }

    // current domain and protocol
    public function siteURL()
    {
        $protocol = stripos($_SERVER['SERVER_PORT'],'443') === 0 ? 'https://' : 'http://';
        $domainName = $_SERVER['HTTP_HOST'].'';
        return $protocol.$domainName;
    }

};

    $d = new DogeBridge($pdo,$config);

    //global sanitize thanbks to https://twitter.com/RichDevX
    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // if cron is runnin, we update the peers, if not, we only validate IP check's
    If (isset($cron)){

        $loop = 10;
        for ($xi = 0; $xi <= $loop; $xi++) {


                // We get all peers/nodes from the Dogecoin Blochain
                $result = $DogePHPbridgeCommand->getpeerinfo();

                $array_days = array(1,4,8,12,16,20,24,28); // reduze the clear banned from 6 to 4 days
                $days = array_search(date("d"), $array_days);
                if ($days >= 1) {
                  if (date("H:i") == "00:05"){
                    // we send the Dogecoin Core command to remove all banned peers to catch again all
                    $DogePHPbridgeCommand->clearbanned();
                  };
                }

                // Go thru all peers detected to add new or update the olde ones
                $total = count($result);
                for ($i = 0; $i < $total; $i++ ) {

                    // if it it dosent fint the peer, we add the new peer to the DB
                    if ($d->FindNode($result[$i]["addr"]) != 1){
                        $d->AddNode($result[$i]["id"],$result[$i]["addr"],$result[$i]["version"],$result[$i]["subver"],json_encode($result[$i]));
                    }else{
                    // if the peer alredy exists then we update the DB with the new data
                        $d->UpdateNode($result[$i]["id"],$result[$i]["addr"],$result[$i]["version"],$result[$i]["subver"],json_encode($result[$i]));
                    };

                    // we ban the IP to be able to detect new peers
                    $pos = strpos($result[$i]["addr"], ']:');
                    if ($pos !== false) {
                      $ip = explode("]:",$result[$i]["addr"]);
                      $ip[0] = str_replace("[", "", $ip[0]);

                    }else{
                        $ip = explode(":",$result[$i]["addr"]);
                    };

                    // we only ban 50% of peers because of the minning and validating process
                    if ($i < ($total / 2)){
                      if ($total > 4){ // only ban if above 5 nodes to prevent the node and wallets from running correctly
                          $result1 = $DogePHPbridgeCommand->setban($ip[0],"add");
                      };
                    };
                };
            sleep(3); // we pause a litle to allow time for the node to process
        };
            $DogePHPbridgeCommand->ping(); // we ping the network to say hello I'm here shibes :P
    };

?>