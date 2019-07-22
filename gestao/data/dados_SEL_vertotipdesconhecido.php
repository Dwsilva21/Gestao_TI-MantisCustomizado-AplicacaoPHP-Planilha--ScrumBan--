<?php
include("../library/funcoes.php");
$con = Conecta("sac");

$query = "SELECT count(*) qtde ";
$query .= " FROM cliente_ip_desconhecido ";

$result = mysqli_query($con, $query) or die("A consulta falhou : " . mysqli_error($con) . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );


    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 .  $rs["qtde"]             . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
