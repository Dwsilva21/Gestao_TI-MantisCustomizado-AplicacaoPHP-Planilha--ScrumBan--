<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/ambiente.php");
include("../library/funcoes.php");
$con = Conecta("sac");

$ordem   = $_REQUEST["ord"];
$sistema = $_REQUEST["sis"];
$modulo  = $_REQUEST["mod"];
$versao  = $_REQUEST["ver"];
$saida   = $_REQUEST["sai"];

if ($ordem == "" ) { 
    $ordem = "1 ";
};
if ($saida == "" ) { 
    $saida = "1";
};


#require_once("../../cliente/mantisbt/lang/strings_portuguese_brazil.txt");
#$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
require_once("../../cliente/mantisbt/config_defaults_inc.php");
require_once("../../cliente/mantisbt/config_inc.php");

$query  = "SELECT d.name sistema, b.summary descricao, ";
$query .= " c.steps_to_reproduce passos, ";
$query .= " c.additional_information clientes, a.bug_id mantis, b.status, FROM_UNIXTIME(b.date_submitted) data, g.value tipo  ";
$query .= "  FROM mantis.mantis_custom_field_string_table a ";
$query .= " INNER JOIN mantis.mantis_bug_table b ON a.bug_id = b.id  ";
$query .= "  LEFT JOIN mantis.mantis_bug_text_table c ON b.bug_text_id = c.id ";
$query .= " INNER JOIN mantis.mantis_project_table d ON b.project_id = d.id ";
$query .= "  LEFT JOIN mantis.mantis_custom_field_string_table g  ON a.bug_id = g.bug_id AND g.field_id = 13 ";
$query .= " WHERE a.value = '" . $versao . "' AND b.project_id = " . $sistema ;

$query  .= " UNION ALL ";

$query .= "SELECT d.name sistema, b.summary descricao, ";
$query .= " c.steps_to_reproduce passos, ";
$query .= " c.additional_information clientes, a.bug_id mantis, b.status, FROM_UNIXTIME(b.date_submitted) data, g.value tipo  ";
$query .= "  FROM mantis.mantis_custom_field_string_table a ";
$query .= " INNER JOIN mantis.mantis_bug_table b ON a.bug_id = b.id  ";
$query .= "  LEFT JOIN mantis.mantis_bug_text_table c ON b.bug_text_id = c.id ";
$query .= " INNER JOIN mantis.mantis_project_table d ON b.project_id = d.id ";
$query .= "  LEFT JOIN mantis.mantis_project_hierarchy_table e ON b.project_id = e.child_id ";
$query .= "  LEFT JOIN mantis.mantis_custom_field_string_table g  ON a.bug_id = g.bug_id AND g.field_id = 13 ";
$query .= " WHERE a.value = '" . $versao . "' AND e.parent_id = " . $sistema ;


$query .= " ORDER by " . $ordem ;
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . $query);

    header("Access-Control-Allow-Origin: *");
    header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
    $outphtml ="";

	
	$outphtml .= "<html>";
    $outphtml .= "<head>";
    $outphtml .= "    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $outphtml .= "    <meta name='title' content='' />";
    $outphtml .= "    <meta name='description' content='' />";
    $outphtml .= "    <title>Título</title>";
    $outphtml .= "</head>";
	
    $outphtml .= "<style>";
    $outphtml .= "#customers { ";
    $outphtml .= "font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; ";
    $outphtml .= "border-collapse: collapse; ";
    $outphtml .= "width: 100%; ";
    $outphtml .= "} ";
    $outphtml .= "#customers td, #customers th { ";
    $outphtml .= "  border: 1px solid #ddd; ";
    $outphtml .= "  padding: 8px; ";
    $outphtml .= "} ";
    $outphtml .= "#customers tr:nth-child(even){background-color: #f2f2f2;} ";
    $outphtml .= "#customers tr:hover {background-color: #ddd;} ";
    $outphtml .= "#customers th { ";
    $outphtml .= "  padding-top: 12px; ";
    $outphtml .= "  padding-bottom: 12px; ";
    $outphtml .= "  text-align: left; ";
    $outphtml .= "  background-color: #4CAF50; ";
    $outphtml .= "  color: white; ";
    $outphtml .= "} ";
    $outphtml .= "</style>  ";
	
    $outphtml .= "<table id='customers' >";	
    $outphtml .= "<tr bgcolor='FFDDDD' >";
    $outphtml .= "<td>Sistema</td>";
    $outphtml .= "<td>Versao</td>";
    $outphtml .= "<td>Descricao</td>";
    $outphtml .= "<td>Tipo</td>";
    $outphtml .= "<td>Passos</td>";
    $outphtml .= "<td>Data</td>";
    $outphtml .= "<td>Mantis</td>";
    $outphtml .= "<td>Status</td>";
    $outphtml .= "</tr>";

	 
	$link = "";
	
	$myold = array( chr(10), chr(13), chr(34), chr(39) , chr(8), "	", chr(92), "ç" , "Ç", "ã", "Ã", "ó", "Ó", "í", "Í", "á", "Á", "ú", "Ú", "é", "É", "ê", "Ê");
	$mynew = array(      "",     " ",     "`",    "``" ,     "",   "", "/", "&ccedil", "&Ccedil", "&atilde", "&Atilde", "&oacute", " &Oacute", "&iacute", " &Iacute", "&aacute", " &Aacute", "&uacute", "&Uacute", "&eacute", "&Eacute", "&ecirc" , "&Ecirc"  );
	
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
       $outp .= '"sistema":"'        	 . str_replace($myold,$mynew,$rs["sistema"])           . '",';
       $outp .= '"versao":"'         	 . $versao                  . '",';
       $outp .= '"descricao":"'   		 . str_replace($myold,$mynew,$rs["descricao"]) . '",';
       $outp .= '"tipo":"'   		     . $rs["tipo"]      . '",';
       $outp .= '"passos":"'   	    	 . str_replace($myold,$mynew,$rs["passos"])    . '",';
       $outp .= '"clientes":"'   	     . str_replace($myold,$mynew,$rs["clientes"])  . '",';
       $outp .= '"mantis":"'   	    	 . $mantis                  . '",';
       $outp .= '"data":"'   	    	 . $rs["data"]              . '",';
       $outp .= '"status":"'   	    	 . $rs["status"]            . '",';
       $outp .= '"label":"'   	    	 . $label                   . '",';
       $outp .= '"labelBR":"'   	     . $labelBR                 . '",';
       $outp .= '"color":"'   	    	 . $color                   . '"}';

	   if ($cnt & 1) { $bgcor = "#FFFFFF"; } else { $bgcor = "#FFFFDD";  } 
	   
	   $outphtml .= "<tr bgcolor='" . $bgcor . "'>";
       $outphtml .= "<td>"        	 . str_replace($myold,$mynew,$rs["sistema"])   . "</td>";
       $outphtml .= "<td>"         	 . $versao                  . "</td>";
       $outphtml .= "<td>"   		 . str_replace($myold,$mynew,$rs["descricao"]) . "</td>";
       $outphtml .= "<td>"   		 . str_replace($myold,$mynew,$rs["tipo"])      . "</td>";
       $outphtml .= "<td>"   	     . str_replace($myold,$mynew,$rs["passos"])    . "</td>";
       $outphtml .= "<td>"   	   	 . $rs["data"]              . "</td>";
       $outphtml .= "<td bgcolor='" . $color . "'><a href='http://uniondata.com.br/cliente/mantisbt/view.php?id=" . $mantis . "' >" . $mantis . "</a></td>";
       $outphtml .= "<td bgcolor='" . $color . "'>"   	   	    . str_replace($myold,$mynew,$labelBR) . "</td>";
	   $outphtml .= "</tr>";
	   
	   
}
$outphtml .="</table>";
$outphtml .="</html>";

$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

if ( $saida == '1' ) { echo    ($outp); }
if ( $saida <> '1' ) { echo($outphtml); }	 


?>
