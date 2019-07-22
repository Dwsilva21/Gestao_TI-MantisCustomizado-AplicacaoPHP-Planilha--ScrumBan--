<?php
session_start(); 
include("../library/funcoes.php");
include("../library/ambiente.php");

$con = conecta("sac");


#$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
require_once("../../cliente/mantisbt/config_defaults_inc.php");
require_once("../../cliente/mantisbt/config_inc.php");


$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};
$id = $_REQUEST["id"];

$query = "";
$query .= "SELECT a.id, b.razao, a.motivo, a.sistema, replace(replace(replace(replace(a.descricao,CHAR(13 USING ASCII),' '),CHAR(10 USING ASCII),' '),CHAR(34),'`'),char(92),'/') descricao, a.programa, ";
$query .= " a.analista, a.datahora_cadastro, a.nome_contato, a.email_contato, a.fone_contato, IF(ISNULL(a.analista),1,2), TIMESTAMPDIFF( MINUTE, a.datahora_cadastro, NOW()) minutos, ";
$query .= " d.bug_id mantis, IFNULL(f.value,'00.00.00') versaoexe, e.status, Chamado_HHMM( a.id ) hhmm ";
$query .= " FROM ocorrencia_Atendimento a LEFT JOIN cliente b ON a.cliente = b.id " ;

$query .= " LEFT  JOIN mantis.mantis_custom_field_string_table d ON instr(d.value,a.id) and d.field_id = 14 ";
$query .= " LEFT  JOIN mantis.mantis_bug_table e ON d.bug_id  = e.id ";
$query .= " LEFT  JOIN mantis.mantis_custom_field_string_table f ON d.bug_id  = f.bug_id AND f.field_id = 17 ";

$query .= " WHERE a.id = " . $id . " ORDER by " . $ordem . " LIMIT 1 ";

$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

	   
	   if ( $rs["mantis"] > 0 )
	   {
	      $mantis  = $rs["mantis"];
		  $g_stat  = $g_status_enum_string . "," ;
          $label   = substr( $g_stat, strpos($g_stat,$rs["status"])+3 , strpos($g_stat,",",strpos($g_stat,$rs["status"]))-strpos($g_stat,$rs["status"])-3 ) ;
		  $g_staBR = $s_status_enum_string . "," ; 
          $labelBR = substr( $g_staBR, strpos($g_staBR,$rs["status"])+3 , strpos($g_staBR,",",strpos($g_staBR,$rs["status"]))-strpos($g_staBR,$rs["status"])-3 ) ;
          $color = $g_status_colors[ $label ];
	   };
	   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"id":"'        		 . $rs["id"]                . '",';
       $outp .= '"razao":"'      		 . $rs["razao"]             . '",';
       $outp .= '"motivo":"'      		 . $rs["motivo"]            . '",';
       $outp .= '"sistema":"'    		 . $rs["sistema"]           . '",';
       $outp .= '"descricao":"'   		 . $rs["descricao"]         . '",';
       $outp .= '"programa":"'     		 . $rs["programa"]          . '",';
       $outp .= '"analista":"'       	 . $rs["analista"]          . '",';
       $outp .= '"datahora_cadastro":"'  . $rs["datahora_cadastro"] . '",';
       $outp .= '"nome_contato":"'       . $rs["nome_contato"]      . '",';
       $outp .= '"email_contato":"'   	 . $rs["email_contato"]     . '",';
       $outp .= '"fone_contato":"'   	 . $rs["fone_contato"]      . '",';
       $outp .= '"minutos":"'            . $rs["minutos"]           . '",';
       $outp .= '"hhmm":"'               . $rs["hhmm"]              . '",';
       $outp .= '"mantis":"'   	    	 . $rs["mantis"]            . '",';
       $outp .= '"verexe":"'      	     . $rs["versaoexe"]         . '",';
       $outp .= '"label":"'   	    	 . $label                   . '",';
       $outp .= '"labelBR":"'   	     . $labelBR                 . '",';
       $outp .= '"color":"'   	    	 . $color                   . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
