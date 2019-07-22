<?
include("conecta3307.php");

$ordem1 = $_REQUEST["ord1"];
if ($ordem1 == "" ) { 
    $ordem1 = "1 ";
};

$query1 = "SELECT a.id, b.razao, a.motivo, a.sistema, replace(replace(a.descricao,CHAR(13 USING ASCII),' '),CHAR(10 USING ASCII),' ') descricao, a.programa, a.analista, a.datahora_cadastro, a.nome_contato, a.email_contato, a.fone_contato, IF(ISNULL(a.analista),1,2), TIMESTAMPDIFF( MINUTE, a.datahora_cadastro, NOW()) minutos ";
$query1 .= " FROM ocorrencia_Atendimento a LEFT JOIN cliente b ON a.cliente = b.id WHERE a.concluido = 0 and isnull(a.analista) ORDER by 12, " . $ordem1 ;
$result1 = mysql_query($query1) or die("A consulta falhou : " . mysql_error());

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	while ($rs = mysql_fetch_assoc($result1)) {
	   $cnt = $cnt + 1;

	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'             . $cnt                     . '",';
       $outp .= '"id":"'               . $rs["id"]                . '",';
       $outp .= '"razao":"'            . $rs["razao"]             . '",';
       $outp .= '"motivo":"'           . $rs["motivo"]            . '",';
       $outp .= '"sistema":"'          . $rs["sistema"]           . '",';
       $outp .= '"descricao":"'        . $rs["descricao"]         . '",';
       $outp .= '"programa":"'         . $rs["programa"]          . '",';
       $outp .= '"analista":"'         . $rs["analista"]          . '",';
       $outp .= '"datahora_cadastro":"'. $rs["datahora_cadastro"] . '",';
       $outp .= '"nome_contato":"'     . $rs["nome_contato"]      . '",';
       $outp .= '"fone_contato":"'     . $rs["fone_contato"]      . '"}';
}
$outp ='{"records":['.$outp.']}';
mysql_free_result($result);

echo($outp);

?>
