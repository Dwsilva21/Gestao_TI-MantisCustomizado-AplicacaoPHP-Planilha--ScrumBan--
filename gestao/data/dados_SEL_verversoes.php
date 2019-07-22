<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/funcoes.php");
$con = Conecta("site");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "11 desc ";
};

$query = "SELECT a.id, a.modulo, a.versao, a.nome, STR_TO_DATE(a.data, '%d/%m/%Y') as data, a.pasta, a.arquivo, a.mantis_project_id, a.desenvolvimento, TIMESTAMPDIFF(DAY,b.datahora,CURRENT_TIMESTAMP ) dias, c.datahora  "; 
$query .= "  FROM modulo a ";
$query .= "  LEFT JOIN modulo_log b ON a.id= b.id and b.datahora = ( SELECT MAX(datahora) FROM modulo_log WHERE id = a.id AND desenvolvimento <> a.desenvolvimento ) ";
$query .= "  LEFT JOIN modulo_log c ON a.id= c.id AND c.datahora = ( SELECT MAX(datahora) FROM modulo_log WHERE id = a.id AND versao <> a.versao ) ";
$query .= " ORDER BY " . $ordem ;



$result = mysqli_query($con, $query) or die(mysqli_error($con));

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );


    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"id":"'      	         . $rs["id"]                . '",';
       $outp .= '"modulo":"'      	     . $rs["modulo"]            . '",';
       $outp .= '"project_id":"'   	     . $rs["mantis_project_id"] . '",';
       $outp .= '"versao":"'      	     . $rs["versao"]            . '",';
       $outp .= '"desenvolvimento":"'    . $rs["desenvolvimento"]   . '",';
       $outp .= '"nome":"'      	     . $rs["nome"]              . '",';
       $outp .= '"data":"'      	     . $rs["data"]              . '",';
       $outp .= '"datahora":"'    	     . $rs["datahora"]          . '",';
       $outp .= '"dias":"'      	     . $rs["dias"]              . '",';
       $outp .= '"pasta":"'      	     . $rs["pasta"]             . '",';
       $outp .= '"arquivo":"'            . $rs["arquivo"]           . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
