<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/funcoes.php");
$con = Conecta("sac");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};

$query = "select a.dump_date, replace(replace(a.dump_value,'13456[','<span style=''background-color:yellow;''>novo</span>['),'134567[','<span style=''background-color:yellow;''>novo</span>[') dump_value ";
$query .= " FROM mantis.logevent a ";
$query .= " WHERE a.dump_event like 'GravaErroNuvemMantis%' ";
$query .= " ORDER BY " . $ordem . ", a.dump_value ";
$query .= " LIMIT 100 ";

$result = mysqli_query($con, $query) or die(mysqli_error($con));

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );


    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"dump_date":"'      	 . $rs["dump_date"]         . '",';
       $outp .= '"dump_value":"'         . $rs["dump_value"]        . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
