<?
include("data/conecta3307.php");
include("lib/funcoes.php");


$remaddr = $_SERVER['REMOTE_ADDR'];
$remuser = $_SERVER['REMOTE_USER'];
$remhost = $_SERVER['REMOTE_HOST'];


$dt= $_REQUEST["dt"];
$cliente= urldecode($_REQUEST["cliente"]); 
# $_REQUEST["cliente"];
$modulo= $_REQUEST["modulo"];

$query = "insert into cliente_log (data,cliente,modulo,ip) values ('" . $dt . "','" . $cliente . "','" . $modulo . "','" . $remaddr . "')";

if ( Verifica_Cliente( $remaddr,$cliente ) == 1 )
{
   $result = mysql_query($query) or die("A consulta falhou : " . mysql_error());
};
#echo $query;
   
?>
