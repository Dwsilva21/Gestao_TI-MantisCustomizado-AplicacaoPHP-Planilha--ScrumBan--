<?php

define("DB_HOST","10.10.1.20");
define("DB_USER","daniel");
define("DB_PASSWORD","biabia");
define("DB_NAME","sac");
define("DB_PORT","3306");

$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


?>
