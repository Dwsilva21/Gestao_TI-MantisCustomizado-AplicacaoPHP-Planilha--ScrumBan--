<?php
include("library/funmsg.php");

$uploadfile = "/tmp/grafico.png";	
$arrto = array( "daniel.wilson@uniondata.com.br", "danielwilson@allwaresolucoes.com.br")	;
$ret = enviaMSG( "daniel.wilson@uniondata.com.br" , $arrto , "teste", "corpo", "aaaa", "");

echo $ret;

?>

