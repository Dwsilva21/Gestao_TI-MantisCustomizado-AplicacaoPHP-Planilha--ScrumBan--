<?
include("data/conecta3307.php");
include("library/funcoes.php");

$cliente    = urldecode($_REQUEST["cliente"]);
$sistema    = $_REQUEST["sistema"];
$versao     = $_REQUEST["versao"];
$programa   = $_REQUEST["programa"];
$rotina     = $_REQUEST["rotina"];
$descricao  = urldecode($_REQUEST["descricao"]);
$linha      = $_REQUEST["linha"];
$numero     = $_REQUEST["numero"];
$data       = "STR_TO_DATE('" . $_REQUEST["data"] . "','%d/%m/%Y %T')";
$usuario    = $_REQUEST["usuario"];
$sequencial = $_REQUEST["sequencial"];

$remaddr = $_SERVER['REMOTE_ADDR'];
$remuser = $_SERVER['REMOTE_USER'];
$remhost = $_SERVER['REMOTE_HOST'];

if ( Verifica_Cliente( $remaddr,$cliente ) == 1 )
{
	$query = "replace into logerro(cliente,sistema,versao,programa,rotina,descricao,linha,numero,data,usuario,sequencial,ip) values('" . $cliente  . "','" . $sistema . "','" . $versao . "','" . $programa . "','" . $rotina . "','" . $descricao . "','" . $linha . "','" . $numero . "'," . $data . ",'" . $usuario . "','" . $sequencial . "','" . $remaddr . "')";
	$result = mysql_query($query) or die("A gravacao falhou : " . mysql_error() . "<br>" . $query );
	{

		$strXML = "<Registro>";
		$strXML .= "<cliente>" . $cliente . "</cliente>";
		$strXML .= "<sistema>" . $sistema . "</sistema>";
		$strXML .= "<programa>" . $programa . "</programa>";
		$strXML .= "<rotina>" . $rotina . "</rotina>";
		$strXML .= "<descricao>" . $descricao . "</descricao>";
		$strXML .= "<linha>" . $linha . "</linha>";
		$strXML .= "<numero>" . $numero . "</numero>";
		$strXML .= "<data>" . $data . "</data>";
		$strXML .= "<usuario>" . $usuario . "</usuario>";
		$strXML .= "<sequencial>" . $sequencial . "</sequencial>";
		$strXML .= "<remaddr>" . $remaddr . "</remaddr>";
		$strXML .= "</Registro>";
		echo $strXML;


    };
};

if ( Verifica_Msg() == 0 ) 
{
   header("Location: msg.php");	
};	


?>