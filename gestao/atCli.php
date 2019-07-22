<?
include("data/conecta3307.php");
include("lib/funcoes.php");


$cliente= urldecode($_REQUEST["id"]);
$versaodb= $_REQUEST["verdb"];
$versaoso= $_REQUEST["veros"];
$ultimatu= $_REQUEST["ultat"];

$remaddr = $_SERVER['REMOTE_ADDR'];
$remuser = $_SERVER['REMOTE_USER'];
$remhost = $_SERVER['REMOTE_HOST'];

if ( Verifica_Cliente( $remaddr,$cliente ) == 1 )
{
   $query = "insert into cliente_dados(id,versaobd,versaoso,ip,usuario,ult_atualizacao) values('" . $cliente  . "','" . $versaodb . "','" . $versaoso . "','" . $remaddr . "','" . $remuser . "','" . $ultimatu . "')";
   $result = mysql_query($query) or die("A gravacao falhou : " . mysql_error() . $query );
   {
      $strXML = "<Registro>";
      $strXML .= "<Versaodb>" . $versaodb . "</Versaodb>";
      $strXML .= "<versaoso>" . $versaoso . "</versaoso>";
      $strXML .= "<ultimatu>" . $ultimatu . "</ultimatu>";
      $strXML .= "<maquina>"  . $remaddr  . "</maquina>";
      $strXML .= "<usuario>"  . $remuser  . "</usuario>";
      $strXML .= "<host>"     . $remhost  . "</host>";
      $strXML .= "</Registro>";
      echo $strXML;
   };
};

?>