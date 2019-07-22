<?
include("conecta3307.php");

$query  = "SELECT a.sistema,b.total,COUNT(*) qtde, ROUND(COUNT(*)*100/b.total,0) perc ";
$query .= "FROM ";
$query .= "( SELECT DISTINCT cliente,sistema,programa,rotina,linha,numero,DATA                              FROM logerro WHERE SUBSTR(DATA,1,10) = SUBSTR(NOW(),1,10)	) a,  ";
$query .= "( SELECT  COUNT(*) total FROM (SELECT DISTINCT cliente,sistema,programa,rotina,linha,numero,DATA FROM logerro WHERE SUBSTR(DATA,1,10) = SUBSTR(NOW(),1,10)) c	) b ";
$query .= "GROUP BY a.sistema ";
$query .= " union all ( SELECT 'TOTAL', COUNT(*), COUNT(*), 100 total FROM (SELECT DISTINCT cliente,sistema,programa,rotina,linha,numero,DATA FROM logerro WHERE SUBSTR(DATA,1,10) = SUBSTR(NOW(),1,10)) d	)  ";

$result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . $query);

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	$link = "";
	
	$myold = array( chr(10), chr(13), chr(34), chr(39) , chr(8), "	", chr(92) );
	$mynew = array(      "",     " ",     "`",    "``" ,     "",   "", "/" );
	
	while ($rs = mysql_fetch_assoc($result)) {
	   $cnt = $cnt + 1;
	   if ($cnt > 4) { $cnt = 1 ;}

   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                     . '",';
       $outp .= '"sistema":"'        	 . $rs["sistema"]           . '",';
       $outp .= '"total":"'         	 . $rs["total"]             . '",';
       $outp .= '"qtde":"'   		     . $rs["qtde"]              . '",';
       $outp .= '"perc":"'   	    	 . $rs["perc"]              . '"}';
}
$outp ='{"records":['.$outp.']}';
mysql_free_result($result);

echo($outp);

?>
