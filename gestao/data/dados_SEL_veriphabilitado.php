<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/funcoes.php");
$con = Conecta("sac");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};

$query = "SELECT replace(a.id,char(34),'`') id, a.ip ";
$query .= " FROM cliente_ip_habilitado a ";
$query .= " ORDER BY " . $ordem ;

$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysql_error($con) . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );


    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"id":"'      	         . $rs["id"]                . '",';
       $outp .= '"ip":"'            	 . $rs["ip"]                . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
