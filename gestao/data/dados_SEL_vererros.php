<?
include("conecta3307.php");

$id = ($_REQUEST["id"]);
$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};

#require_once("../../cliente/mantisbt/lang/strings_portuguese_brazil.txt");
$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
require_once("../../cliente/mantisbt/config_defaults_inc.php");
require_once("../../cliente/mantisbt/config_inc.php");

$query = "SELECT a.cliente,a.sistema,a.programa,a.rotina,a.descricao,a.linha,a.numero,a.data,a.usuario,a.sequencial,a.ip, a.mantis, b.id local,b.ip as ipexc, c.status, a.versao, IFNULL(d.value,'00.00.00') versaoexe ";
$query .= " FROM logerro a ";
$query .= " LEFT JOIN cliente_ip_bloqueado    b ON a.ip = b.ip  ";
$query .= " LEFT JOIN mantis.mantis_bug_table c ON a.mantis = c.id ";
$query .= " LEFT JOIN mantis.mantis_custom_field_string_table d ON a.mantis = d.bug_id AND d.field_id = 17 ";
$query .= " WHERE a.cliente = '" . $id . "' and a.data > '2017-06-01' AND a.ip NOT IN ( SELECT ip FROM sac.cliente_ip_bloqueado ) and not ( a.mantis = 0 and  b.ip is not null ) ";
$query .= "   AND a.mantis NOT in ( select id FROM mantis.mantis_bug_table where status in (80,90)) ";
$query .= " ORDER BY " . $ordem ;

$result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	$link = "";
    $myold = array( chr(10), chr(13), chr(34), chr(39) , chr(8), "	" );
	$mynew = array(      "",     " ",     "`",    "``" ,     "",   "" );

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
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"sistema":"'      	     . $rs["sistema"]           . '",';
       $outp .= '"versao":"'      	     . $rs["versao"]            . '",';
       $outp .= '"programa":"'      	 . $rs["programa"]          . '",';
       $outp .= '"rotina":"'      		 . $rs["rotina"]            . '",';
       $outp .= '"descricao":"'   		 . str_replace($myold,$mynew,$rs["descricao"]) . '",';
       $outp .= '"linha":"'    	         . $rs["linha"]             . '",';
       $outp .= '"numero":"'    		 . $rs["numero"]            . '",';
       $outp .= '"data":"'           	 . $rs["data"]              . '",';
       $outp .= '"usuario":"'         	 . $rs["usuario"]           . '",';
       $outp .= '"sequencial":"'       	 . $rs["sequencial"]        . '",';
       $outp .= '"ip":"'            	 . $rs["ip"]                . '",';
       $outp .= '"ipexc":"'            	 . $rs["ipexc"]             . '",';
       $outp .= '"local":"'            	 . $rs["local"]             . '",';
       $outp .= '"mantis":"'   	    	 . $rs["mantis"]            . '",';
       $outp .= '"verexe":"'      	     . $rs["versaoexe"]         . '",';
       $outp .= '"label":"'   	    	 . $label                   . '",';
       $outp .= '"labelBR":"'   	     . $labelBR                 . '",';
       $outp .= '"color":"'   	    	 . $color                   . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysql_free_result($result);

echo($outp);

?>
