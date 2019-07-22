<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/funcoes.php");
$con = Conecta("sac");

$id = str_replace("^","&",$_REQUEST["id"]);
$ip = $_REQUEST["ip"];
$aba = $_REQUEST["aba"];


$query1 = "REPLACE INTO cliente_ip_bloqueado(id,ip) ( SELECT id,ip FROM cliente_ip_desconhecido WHERE id = '" . $id . "' and ip = '" . $ip . "' ) ";
$result1 = mysqli_query($con, $query1) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query1);

$query2 = "DELETE FROM cliente_ip_desconhecido WHERE id = '" . $id . "' and ip = '" . $ip . "' ";
$result2 = mysqli_query($con, $query2) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query2);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );


    $cnt = 0;
    $outp = "";	

	$cnt = $cnt + 1;

   
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"cnt":"'        		 . $cnt    . '",';
    $outp .= '"id":"'      	         . $id     . '",';
    $outp .= '"ip":"'                . $ip     . '"}';
	   
$outp ='{"records":['.$outp.']}';
#mysqli_free_result($result);

#echo($outp);
?>
<script>
 window.open('../VerIPDesconhecido.php?aba=<?php echo $aba?>' ,"_self");
</script>
