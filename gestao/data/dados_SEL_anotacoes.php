<?php
session_start(); 
include("../library/funcoes.php");
include("../library/ambiente.php");

$con = conecta("sac");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};
$id = $_REQUEST["id"];

$query  = " SELECT a.id, a.chamado, a.responsavel, a.datahora, ";
$query .= " a.descricao, ";
$query .= " a.motivoenc, a.status, a.tempo ";
$query .= " FROM logchamado a WHERE a.chamado = " . $id . " ORDER by " . $ordem  ;
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                      . '",';
       $outp .= '"id":"'      		     . $rs["id"]                 . '",';
       $outp .= '"chamado":"'      		 . $rs["chamado"]            . '",';
       $outp .= '"responsavel":"'    	 . $rs["responsavel"]        . '",';
       $outp .= '"datahora":"'    		 . $rs["datahora"]           . '",';
       $outp .= '"descricao":"'   		 . str_replace($myold,$mynew,$rs["descricao"]) . '",';
       $outp .= '"motivoenc":"'     	 . $rs["motivoenc"]          . '",';
       $outp .= '"tempo":"'     	     . $rs["tempo"]              . '",';
       $outp .= '"status":"'             . $rs["status"]             . '"}';
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
