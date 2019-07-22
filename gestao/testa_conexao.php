<?php
session_start();
ini_set('default_charset','iso-8859-1');
echo("vou tentar conectar....<br>");

   define("DB_HOST","askhost.ddns.net");
   define("DB_USER","root");
   define("DB_PASSWORD","senha");
   define("DB_NAME","jpw");
   
   $mycon = new mysqli(DB_HOST, DB_USER, DB_PASSWORD );
   $banco = mysqli_select_db($mycon,$db);

   if (mysqli_connect_errno()) {
       die("Connect failed: %s\n" . mysqli_connect_error());
   } else { echo "conectou"; }
 
echo "1.<BR>";
if ( $mycon ){ echo "ok"; }
echo "2.<BR>";


?>
