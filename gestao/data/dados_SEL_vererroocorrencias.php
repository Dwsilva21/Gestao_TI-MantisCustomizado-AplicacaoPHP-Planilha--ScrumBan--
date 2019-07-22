<?
include("conecta3307.php");


$sis = $_REQUEST["sis"];
$pro = $_REQUEST["pro"];
$rot = $_REQUEST["rot"];
$lin = $_REQUEST["lin"];
$num = $_REQUEST["num"];

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "8 ";
};

#require_once("../../cliente/mantisbt/lang/strings_portuguese_brazil.txt");
$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
require_once("../../cliente/mantisbt/config_defaults_inc.php");
require_once("../../cliente/mantisbt/config_inc.php");

$query = "SELECT a.cliente,a.data,a.usuario,a.sequencial,a.ip, a.mantis, b.id local,b.ip as ipexc, c.status, a.versao ";
$query .= " FROM logerro a ";
$query .= " LEFT JOIN cliente_ip_bloqueado    b ON a.ip = b.ip  ";
$query .= " LEFT JOIN mantis.mantis_bug_table c ON a.mantis = c.id ";
$query .= " WHERE a.sistema  = '" . $sis . "' ";
$query .= "   and a.programa = '" . $pro . "' ";
$query .= "   and a.rotina   = '" . $rot . "' ";
$query .= "   and a.linha    = '" . $lin . "' ";
$query .= "   and a.numero   = '" . $num . "' ";
$query .= "   and a.data > '2017-06-01' ";
$query .= "   AND a.mantis NOT in ( select id FROM mantis.mantis_bug_table where status in (80,90)) ";
$query .= " ORDER BY " . $ordem ;

$result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . $query);

#echo $query;

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
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"id":"'      	         . $rs["cliente"]           . '",';
       $outp .= '"datahora":"'        	 . $rs["data"]              . '",';
       $outp .= '"usuario":"'         	 . $rs["usuario"]           . '",';
       $outp .= '"sequencial":"'       	 . $rs["sequencial"]        . '",';
       $outp .= '"ip":"'            	 . $rs["ip"]                . '",';
       $outp .= '"ipexc":"'            	 . $rs["ipexc"]             . '",';
       $outp .= '"local":"'            	 . $rs["local"]             . '",';
       $outp .= '"versao":"'          	 . $rs["versao"]            . '",';
       $outp .= '"mantis":"'   	    	 . $mantis                  . '",';
       $outp .= '"label":"'   	    	 . $label                   . '",';
       $outp .= '"labelBR":"'   	     . $labelBR                 . '",';
       $outp .= '"color":"'   	    	 . $color                   . '"}';
	   
}
$outp ='{"records":['.$outp.']}';
mysql_free_result($result);

echo($outp);

?>
