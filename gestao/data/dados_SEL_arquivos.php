<?php
session_start(); 
include("../library/funcoes.php");
include("../library/ambiente.php");

$con = conecta("sac");


#$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
require_once("../../cliente/mantisbt/config_defaults_inc.php");
require_once("../../cliente/mantisbt/config_inc.php");


$id = $_REQUEST["id"];

$query = "";
$query .= "SELECT a.idchamado, a.nome, a.contentType, a.id ";
$query .= " FROM anexo a " ;
$query .= " WHERE a.idchamado = " . $id . " ORDER by a.id desc" ;

$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;
   
	   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"idchamado":"'    	 . $rs["idchamado"]         . '",';
       $outp .= '"cnt":"'      		     . $cnt                     . '",';
       $outp .= '"id":"'      		     . $rs["id"]                . '",';
       $outp .= '"nome":"'      		 . $rs["nome"]              . '",';
       $outp .= '"conteudo":"'   	  	 . str_replace("/","_",$rs["contentType"])          . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
