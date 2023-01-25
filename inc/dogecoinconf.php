<?php
header('Content-type: text/plain');
?>
<?php
header('Content-Disposition: attachment; filename="dogecoin.conf"');
?>
##
## dogecoin.conf configuration file. Lines beginning with # are comments.
##
## more info in https://github.com/dogecoin/dogecoin/blob/master/doc/files.md
##

uacomment=<?php echo $_GET["hash"]."\n"; ?>