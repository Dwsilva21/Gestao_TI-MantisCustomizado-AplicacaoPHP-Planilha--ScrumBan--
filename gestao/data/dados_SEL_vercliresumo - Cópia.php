<?
include("conecta3307.php");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};


$view   = "( SELECT x.id ,x.versaobd,x.data ,x.versaoso,x.usuario,x.ip,x.ult_atualizacao FROM cliente_dados x LEFT JOIN cliente_ip_bloqueado y ON x.ip = y.ip WHERE y.ip IS NULL ) ";
$query = "SELECT  left(a.versaobd,1) as versaobd, count(*) as qtde FROM " . $view . " a WHERE a.data = ( SELECT MAX(b.data) FROM " . $view . " b WHERE b.id = a.id GROUP BY b.id ) GROUP BY left(a.versaobd,1) ORDER BY left(a.versaobd,1)";
$result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . $query );

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	while ($rs = mysql_fetch_assoc($result)) {
	   $cnt = $cnt + 1;

	   $vBD  = $rs["versaobd"];
	   $vSO  = $rs["versaoso"];
	   if (strpos($vBD,"-nt") > 0) {
	      if ($vSO == "") {
		     $vSO = "Windows";
		  };
	   }; 
	   $bgcolor = "#BDE2FF";
       if (substr($vBD,0,1) == "4") { $bgcolor = "#FF0000"; }	  

	   
	   if ($outp != "") {$outp .= ",";}
       $outp .= '{"cnt":"'        		 . $cnt                    . '",';
       $outp .= '"versaobd":"'      	 . $rs["versaobd"]         . '",';
       $outp .= '"bgcolor":"'    		 . $bgcolor                . '",';
       $outp .= '"qtde":"'               . $rs["qtde"]             . '"}';
}
$outp ='{"records":['.$outp.']}';
mysql_free_result($result);

echo($outp);

?>



 