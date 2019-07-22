<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/funcoes.php");
$con = Conecta("sac");

$id  = str_replace("^","&",$_REQUEST["id"]);
$ip  = $_REQUEST["ip"];
$aba = $_REQUEST["aba"];

$ret = 0;
$query = "select id from cliente_sistemas where id = '" . $id . "' ";
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . " = " . $query); 
if ($rs = mysqli_fetch_assoc($result))
{
} else {
   $query0  = "INSERT into cliente_sistemas(id) values( '" . $id . "')";
   $result0 = mysqli_query($con,$query0) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query0);
};

$query1 = "REPLACE INTO cliente_ip_habilitado(id,ip) ( SELECT id,ip FROM cliente_ip_desconhecido WHERE ip NOT IN ( SELECT ip FROM cliente_ip_bloqueado ) and id = '" . $id . "' and ip = '" . $ip . "' ) ";
$result1 = mysqli_query($con,$query1) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query1);

$query2 = "DELETE FROM cliente_ip_desconhecido WHERE ip NOT IN ( SELECT ip FROM cliente_ip_bloqueado ) and id = '" . $id . "' and ip = '" . $ip . "' ";
$result2 = mysqli_query($con,$query2) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query2);


$query3 = "UPDATE cliente_log SET cliente = NULL WHERE (cliente = '' OR ISNULL(cliente)) and ip = '" . $ip . "' ";
$result3 = mysqli_query($con,$query3) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query3);

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
mysqli_free_result($result);


#echo $query  . "a<BR>";
#echo $query1 . "b<BR>";
#echo $query2 . "c<BR>";
#echo $query3 . "d<BR>";


?>
<script>
  window.open('../VerIPDesconhecido.php?aba=<?php echo $aba?>' ,"_self");  
</script>
