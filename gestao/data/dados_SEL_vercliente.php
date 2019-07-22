<?
include("../library/conecta3307.php");
include("../library/ambiente.php");

$id = urldecode($_REQUEST["id"]);
$ordem = $_REQUEST["ord"];
$limit = $_REQUEST["lim"];
if ($ordem == "" ) { 
    $ordem = "1 desc";
};
if ($limit == "" ) { 
    $limit = "10";
};

require_once("../../cliente/mantisbt/config_defaults_inc.php");
require_once("../../cliente/mantisbt/config_inc.php");


$query  = "SELECT a.id, a.motivo, a.sistema, a.descricao, a.programa, a.datahora_cadastro, a.nome_contato, a.fone_contato, c.responsavel analista, a.email_contato, d.bug_id as mantis, c.status manstatus, e.status, IFNULL(f.value,'00.00.00') versaoexe, IFNULL(g.qtanexo,0) qtanexo, b.razao  ";
$query .= " FROM ocorrencia_Atendimento a ";
$query .= " INNER JOIN cliente    b ON a.cliente = b.id ";
$query .= " INNER JOIN logchamado c ON a.id      = c.chamado ";
$query .= " LEFT  JOIN mantis.mantis_custom_field_string_table d ON instr(d.value,a.id) and d.field_id = 14 ";
$query .= " LEFT  JOIN mantis.mantis_bug_table e ON d.bug_id  = e.id ";
$query .= " LEFT  JOIN mantis.mantis_custom_field_string_table f ON d.bug_id  = f.bug_id AND f.field_id = 17 ";
$query .= " LEFT  JOIN ( select idchamado, count(*) qtanexo from anexo group by idchamado ) g ON a.id  = g.idchamado ";

$query .= " WHERE b.razao = '" . $id . "'" ;
$query .= "   and c.id = ( select max(id) from logchamado where chamado = a.id group by chamado )";
$query .= " ORDER by " . $ordem . " limit " . $limit ;

# echo $query;

$result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	$link = "";

	while ($rs = mysql_fetch_assoc($result)) {
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
       $outp .= '{"cnt":"'        		 . $cnt                       . '",';
       $outp .= '"id":"'      	         . $rs["id"]                  . '",';
       $outp .= '"razao":"'      	     . $rs["razao"]               . '",';
       $outp .= '"motivo":"'      	     . $rs["motivo"]              . '",';
       $outp .= '"sistema":"'      		 . str_replace($myold,$mynew,$rs["sistema"])   . '",';
       $outp .= '"descricao":"'   		 . str_replace($myold,$mynew,$rs["descricao"]) . '",';
       $outp .= '"manstatus":"'    	     . $rs["manstatus"]           . '",';
       $outp .= '"programa":"'    		 . $rs["programa"]            . '",';
       $outp .= '"analista":"'           . $rs["analista"]            . '",';
       $outp .= '"datahora_cadastro":"'  . $rs["datahora_cadastro"]   . '",';
       $outp .= '"nome_contato":"'       . $rs["nome_contato"]        . '",';
       $outp .= '"fone_contato":"'       . $rs["fone_contato"]        . '",';
       $outp .= '"email_contato":"'      . $rs["email_contato"]       . '",';
       $outp .= '"mantis":"'   	    	 . $rs["mantis"]              . '",';
       $outp .= '"status":"'      	     . $rs["status"]              . '",';
       $outp .= '"verexe":"'      	     . $rs["versaoexe"]           . '",';
       $outp .= '"qtanexo":"'   	     . $rs["qtanexo"]             . '",';
       $outp .= '"labelBR":"'   	     . $labelBR                   . '",';
       $outp .= '"color":"'   	    	 . $color                     . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysql_free_result($result);

echo($outp);

?>
