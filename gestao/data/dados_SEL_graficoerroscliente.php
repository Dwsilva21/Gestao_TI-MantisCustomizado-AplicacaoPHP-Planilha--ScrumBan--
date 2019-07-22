<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/funcoes.php");
$con = Conecta("sac");

$todos   = $_REQUEST["all"];

$from  = " FROM logerro a ";
$from .= " LEFT JOIN mantis.mantis_bug_table b ON a.mantis = b.id ";


if ( $todos == 0 ) { $where = " WHERE SUBSTR(DATA,1,10) = SUBSTR(NOW(),1,10) and ip NOT IN ( SELECT ip FROM sac.cliente_ip_bloqueado ) and IF(ISNULL(b.id),IF(a.mantis=0,99,90),b.status) NOT IN (80,90)  "; } 
if ( $todos == 1 ) { $where = " WHERE DATA > '2017-06-01'                    and ip NOT IN ( SELECT ip FROM sac.cliente_ip_bloqueado ) and IF(ISNULL(b.id),IF(a.mantis=0,99,90),b.status) NOT IN (80,90)  "; } 


$query  = "SELECT a.cliente,b.total,COUNT(*) qtde, ROUND(COUNT(*)*100/b.total,0) perc ";
$query .= " FROM ";
$query .= "( SELECT DISTINCT cliente,sistema,programa,rotina,linha,numero                      " . $from . $where . "	) a,  ";
$query .= "( SELECT  COUNT(*) total FROM (SELECT DISTINCT sistema,programa,rotina,linha,numero " . $from . $where . " ) c	) b ";
$query .= " GROUP BY a.cliente having ROUND(COUNT(*)*100/b.total,0) >= 3 ";
$query .= " union all ( SELECT 'TOTAL', COUNT(*), COUNT(*), 100 total FROM (SELECT DISTINCT sistema,programa,rotina,linha,numero  " . $from . $where . ") d	)  ";


$result = mysqli_query($con, $query) or die(mysqli_error($con));


header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	$link = "";
	
	$myold = array( chr(10), chr(13), chr(34), chr(39) , chr(8), "	", chr(92) );
	$mynew = array(      "",     " ",     "`",    "``" ,     "",   "", "/" );
	
	while ($rs = mysqli_fetch_assoc($result)) {
	   $cnt = $cnt + 1;
	   if ($cnt > 4) { $cnt = 1 ;}

   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"cliente":"'        	 . $rs["cliente"]           . '",';
       $outp .= '"total":"'         	 . $rs["total"]             . '",';
       $outp .= '"qtde":"'   		     . $rs["qtde"]              . '",';
       $outp .= '"perc":"'   	    	 . $rs["perc"]              . '"}';
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);

?>
