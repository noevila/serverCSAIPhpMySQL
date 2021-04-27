<?php

$db = mysqli_init();
if (!$db) {
  die("mysqli_init failed");
}

$db -> ssl_set("key.pem", "cert.pem", "cacert.pem", NULL, NULL); 

if (!$db -> real_connect("192.168.1.55","db","dbdb","login")) {
  die("Connect Error: " . mysqli_connect_error());
}

?>
