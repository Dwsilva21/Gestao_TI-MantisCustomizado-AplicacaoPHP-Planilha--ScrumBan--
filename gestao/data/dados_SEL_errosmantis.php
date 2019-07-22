<?php
session_start(); 
include("../library/funcoes.php");
include("../library/ambiente.php");

$con = conecta("sac");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};

#require_once("../../cliente/mantisbt/lang/strings_portuguese_brazil.txt");
#$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
require_once("../../cliente/mantisbt/config_defaults_inc.php");
require_once("../../cliente/mantisbt/config_inc.php");


$query  = "SELECT a.programa,a.rotina,a.linha,a.numero,MAX(a.descricao) descricao, COUNT(*) qtde, a.mantis, b.status, max(data) ultdata,a.sistema, MAX(IFNULL(c.value,'00.00.00')) versao ";
$query .= "FROM logerro a ";
$query .= " LEFT JOIN mantis.mantis_bug_table b ON a.mantis = b.id ";
$query .= " LEFT JOIN mantis.mantis_custom_field_string_table c ON a.mantis = c.bug_id AND c.field_id = 17 ";
$query .= "WHERE a.data  >= '2017-06-01' AND a.ip NOT IN ( SELECT ip FROM sac.cliente_ip_bloqueado ) and IF(ISNULL(b.id),IF(a.mantis=0,99,90),b.status) NOT IN (80,90) " ;
$query .= " GROUP BY  a.sistema,a.programa,a.rotina,a.linha,a.numero,a.mantis,b.status "; 
$query .= " ORDER by " . $ordem ;
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	$link = "";
	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

	   $label   = "";
	   $labelBR = "";
	   $color   = "";
	   $mantis  = "";
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
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"sistema":"'        	 . $rs["sistema"]           . '",';
       $outp .= '"programa":"'      	 . $rs["programa"]          . '",';
       $outp .= '"rotina":"'      		 . $rs["rotina"]            . '",';
       $outp .= '"linha":"'    	         . $rs["linha"]             . '",';
       $outp .= '"numero":"'    		 . $rs["numero"]            . '",';
       $outp .= '"descricao":"'   		 . str_replace($myold,$mynew,$rs["descricao"])        . '",';
       $outp .= '"mantis":"'   	    	 . $mantis                  . '",';
       $outp .= '"versao":"'   	    	 . $rs["versao"]            . '",';
       $outp .= '"status":"'   	    	 . $rs["status"]            . '",';
       $outp .= '"ultdata":"'        	 . $rs["ultdata"]           . '",';
       $outp .= '"label":"'   	    	 . $label                   . '",';
       $outp .= '"labelBR":"'   	     . $labelBR                 . '",';
       $outp .= '"color":"'   	    	 . $color                   . '",';
       $outp .= '"qtde":"'               . $rs["qtde"]              . '"}';
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
