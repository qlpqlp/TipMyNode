<?php
/**
*   File: Index file of Tip My Node
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/
    // Now we include the basic configurations for TipMyNode Map
    include("config.php");
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TipMyNode</title>
  <meta name="description" content="Tip My Dogecoin Node">
  <meta name="author" content="All Dogecoin Community!">
  <meta name="generator" content="You!">
  <link href="<?php echo $d->siteURL(); ?>/img/TipMyNode.png" rel="icon" />
  <link href="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/doge.css" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<!--
bs58caddr.bundle.min.js

The MIT License (MIT)

Copyright (c) 2023 Patrick Lodder

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
-->
  <script src="../js/bs58caddr.bundle.min.js"></script>
<style type="text/css">
*{
    word-break: break-word;
}
</style>
</head>
<body style="padding: 15px">
  <div class="content">
  <div class="row">
    <div class="col">

<?php
    // we get the Shibe Doge Address and added to the DataBase
    if (isset($_POST["dogeaddress"])){
      $dogeaddress = filter_var($_POST["dogeaddress"], FILTER_SANITIZE_STRING);
      $node_hash = hash('sha256', $dogeaddress.$dbsalt); // we create an unique Hash to somehow minimise de-anonymise of the node for privacy protection
      $d->AddTipMyNode($dogeaddress,$node_hash);
?>
        <div class="alert alert-success" role="alert"><i class="fa-solid fa-paw"></i> Much thanks! Now do the following below</div>
        <div style="text-align: left; padding: 15px">
        <div style="border: 1px solid #999999; padding: 15px; border-radius: 25px">
        <span class="badge rounded-pill bg-success">1º</span> <b>Copy this:</b> uacomment = <?php echo $node_hash; ?>
        <br>and add on your <b>dogecoin.conf</b> file or you can download an <b>auto generated dogecoin.conf file</b> clicking <a href="dogecoinconf.php?hash=<?php echo $node_hash; ?>" target="_blank">here</a> and add on your Dogecoin Core Node folder of your Operating System:<br>
        <br>
        <b class="badge rounded-pill bg-primary"><i class="fa-brands fa-linux"></i> Linux</b>	$HOME/.dogecoin/<br>
        <b class="badge rounded-pill bg-primary"><i class="fa-brands fa-apple"></i> macOS</b>	$HOME/Library/Application Support/Dogecoin/<br>
        <b class="badge rounded-pill bg-primary"><i class="fa-brands fa-windows"></i> Windows</b>	%APPDATA%\Dogecoin\<br>
        </div>
        <br>
        <div style="border: 1px solid #999999; padding: 15px; border-radius: 25px">
        <span class="badge rounded-pill bg-success">2º</span> <b>Restart your Dogecoin Core Node</b> and wait a few days until the TipMyNode.com website finds your Hash to display your Node Doge Address on the Map to be tip.
        </div>
        </div>

        <div class="alert alert-warning" role="alert" >
          <i class="fa-solid fa-triangle-exclamation"></i> Only works if your node is fully working and with the Hash on <b>uacomment</b>. Learn more how to setup your full node <a href="https://github.com/dogecoin/dogecoin/blob/master/doc/getting-started.md#starting-a-dogecoin-node" target="_blank">here</a> It can take a few days for your node to be found.
        </div>
<?php
}else{
?>
        <div class="alert alert-warning" role="alert">
          <i class="fa-solid fa-paw"></i> Add your Dogecoin Address to receive tips in Doge for running your Node.
        </div>
        <form method="post" id="tipmynode">
        <div class="form-group" style="margin: 5px">
          <input name="dogeaddress" type="text" class="form-control" id="dogeaddress" placeholder="Doge Address to receive tips"aria-describedby="doge_address_in" required="required">
        </div>
        <div class="form-check" style="margin: 5px; text-align: left; margin-bottom: 15px">
          <input class="form-check-input" type="checkbox" value="agree" id="warning" required="required">
          <label class="form-check-label" for="flexCheckDefault">
            I allow my node to be <a href="https://en.wiktionary.org/wiki/deanonymize" target="_blank">de-anonymized</a> to be able to recive tips in Dogecoin.
          </label>
        </div>
          <button type="submit" class="btn btn-success" ><i class="fa-solid fa-bone"></i> Much Submit!</button>
        </form>
        <script>
            // Thanks to https://twitter.com/patricklodder we can check if the DogeAddress is valid
            $( "#tipmynode" ).submit(function( event ) {
                const dogecoinAddress = $( "#dogeaddress" ).val();
                if (!bs58caddr.validateCoinAddress('DOGE', dogecoinAddress)) {
                    event.preventDefault();
                    alert('Doge Address Not Valid');
                }
            });
        </script>
<?php
};
?>
    </div>
  </div>
  </div>
</body>
</html>