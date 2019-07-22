<!DOCTYPE html>
<?php
include("library/funcoes.php");
include("library/conecta3307.php");

$usr = "Daniel";
$pwd = "dwsa";

$acs = Verifica_Usuario($usr, $pwd, $con); 
	 
echo 	$acs; 
?>
