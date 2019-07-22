<?php
session_start(); 
include("../library/funcoes.php");

$con = conecta("sac");

$query   = " SELECT SUM( IF(  conpag='S' , 1, 0 ) )  totconpag, ";
$query  .= "        SUM( IF(  folha='S'  , 1, 0 ) )   totfolha, ";
$query  .= "        SUM( IF(  locacao='S', 1, 0 ) ) totlocacao, ";
$query  .= "        SUM( IF(  condo='S'  , 1, 0 ) )   totcondo, ";
$query  .= "        SUM( IF(  front='S'  , 1, 0 ) )   totfront, ";
$query  .= "      COUNT( * )   totqtde                          ";
$query  .= "   FROM cliente_sistemas ";
$query  .= "  WHERE ativo='S'  ";
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query );

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

	   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                       . '",';
       $outp .= '"conpag":"'             . $rs["totconpag"]           . '",';
       $outp .= '"folha":"'              . $rs["totfolha"]            . '",';
       $outp .= '"loca":"'               . $rs["totlocacao"]          . '",';
       $outp .= '"condo":"'              . $rs["totcondo"]            . '",';
       $outp .= '"front":"'              . $rs["totfront"]            . '",';
       $outp .= '"qtde":"'               . $rs["totqtde"]             . '"}';
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>



 