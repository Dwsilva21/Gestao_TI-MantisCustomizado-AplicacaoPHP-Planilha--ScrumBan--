<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
include("library/conecta3307.php");
include("library/funmsg.php");

$myold = array( chr(10), chr(13), chr(34), chr(39) , chr(8), "	", chr(92), "ç" , "Ç", "ã", "Ã", "ó", "Ó", "í", "Í", "á", "Á", "ú", "Ú", "é", "É", "ê", "Ê");
$mynew = array(      "",     " ",     "`",    "``" ,     "",   "", "/", "&ccedil", "&Ccedil", "&atilde", "&Atilde", "&oacute", " &Oacute", "&iacute", " &Iacute", "&aacute", " &Aacute", "&uacute", "&Uacute", "&eacute", "&Eacute", "&ecirc" , "&Ecirc"  );
$url = "";

$id = $_REQUEST["id"];

$query1 .= "SELECT a.id sequencial, a.responsavel, a.descricao, a.status , b.descricao deschamado, b.email_contato ";
$query1 .= "FROM logchamado a ";
$query1 .= "INNER JOIN ocorrencia_Atendimento b ON a.chamado = b.id ";
$query1 .= "WHERE a.chamado = " . $id ;
$query1 .= " ORDER BY a.id DESC LIMIT 1 ";
$result1 = mysql_query($query1) or die("A consulta falhou : " . mysql_error() . "<BR>" . $query1); 

if ($rs = mysql_fetch_assoc($result1))
{	
    $outphtml = "";
	$outphtml .= "<html>";
    $outphtml .= "<head>";
    $outphtml .= "    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $outphtml .= "    <meta name='title' content='' />";
    $outphtml .= "    <meta name='description' content='' />";
    $outphtml .= "    <title>Título</title>";
    $outphtml .= "</head>";
	
    $outphtml .= "<style>";
    $outphtml .= "#customers { ";
    $outphtml .= "font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; ";
    $outphtml .= "border-collapse: collapse; ";
    $outphtml .= "width: 100%; ";
    $outphtml .= "} ";
    $outphtml .= "#customers td, #customers th { ";
    $outphtml .= "  border: 1px solid #ddd; ";
    $outphtml .= "  padding: 8px; ";
    $outphtml .= "} ";
    $outphtml .= "#customers tr:nth-child(even){background-color: #f2f2f2;} ";
    $outphtml .= "#customers tr:hover {background-color: #ddd;} ";
    $outphtml .= "#customers th { ";
    $outphtml .= "  padding-top: 12px; ";
    $outphtml .= "  padding-bottom: 12px; ";
    $outphtml .= "  text-align: left; ";
    $outphtml .= "  background-color: #4CAF50; ";
    $outphtml .= "  color: white; ";
    $outphtml .= "} ";
    $outphtml .= "</style>  ";

    $outphtml .= "<table id='customers' >";	
    $outphtml .= "<tr bgcolor='FFDDDD' >";
    $outphtml .= "<td>No</td>";
    $outphtml .= "<td>Chamado</td>";
    $outphtml .= "<td>Anotacao</td>";
    $outphtml .= "<td>Responsavel</td>";
    $outphtml .= "<td>status</td>";
    $outphtml .= "</tr>";
 
	$bgcor = "#FFFFDD";
    $outphtml .= "<tr bgcolor='" . $bgcor . "'>";
    $outphtml .= "<td>"        	 .  $id . "<br>Seq.[" . $rs["sequencial"] . "]</td>";
    $outphtml .= "<td>"       	 .  utf8_encode($rs["deschamado"])   . "</td>";
    $outphtml .= "<td>"   		 .  utf8_encode($rs["descricao"])    . "</td>";
    $outphtml .= "<td>"   		 . str_replace($myold,$mynew,utf8_encode($rs["responsavel"])) . "</td>";
    $outphtml .= "<td>"   	     . str_replace($myold,$mynew,utf8_encode($rs["status"]))     . "</td>";
	$outphtml .= "</tr>";
    $outphtml .="</table>";
	
    $arrto = array( $rs["email_contato"] ,"daniel.wilson@uniondata.com.br" )	;
    $ret = enviaMSG( "suporte@uniondata.com.br" , $arrto , "Andamento de Atendimento (SUPORTE)", $outphtml);

}

$url = "VerChamado.php?id=" . $id ;
if ( $rs["status"] == "FINALIZADO" ) { $url = "VerAtendimento.php" ; }
// echo "URL=" . $url;

?>
<script>
 alert("<? echo $ret ?>");
 window.open("<? echo $url ?>","iframe_a");  
</script>

