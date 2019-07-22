<?
include("conecta.php");
$query = "select * from modulo order by id";
$result = mysql_query($query) or die("A consulta falhou : " . mysql_error());
$strMOD= array();
while ($rs = mysql_fetch_assoc($result)) {
	$strMOD[$rs["id"]] =  $rs["versao"];
}

include("conecta3307.php");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};


$view   = "( SELECT x.id ,x.versaobd,x.data ,x.versaoso,x.usuario,x.ip,x.ult_atualizacao FROM cliente_dados x LEFT JOIN cliente_ip_bloqueado y ON x.ip = y.ip WHERE y.ip IS NULL ) ";

$query  = " SELECT replace(a.id,char(34),'`') id, a.versaobd, a.versaoso,  a.ip, a.data, a.ult_atualizacao, b.qtd_erros, b.qtd_mantis, b.qtd_total, if( b.qtd_erros > 0 ,b.qtd_dist-1,b.qtd_dist) as qtd_dist, ";
$query .= "        c.conpag, c.folha, c.loca, c.condo, c.front, " ;
$query .= "        if( c.conpag = '" . $strMOD[4] . "',1,0) as atuconpag, if( c.folha = '" . $strMOD[12] . "',1,0) as atufolha, if( c.loca ='" . $strMOD[10] . "',1,0) as atuloca, ";
$query .= "        if( c.condo = '" . $strMOD[3] . "',1,0) as atucondo, if( c.front = '" . $strMOD[9] . "',1,0) as atufront, if( a.ult_atualizacao = '" . $strMOD[13] . "',1,0) as atudb ";
$query .= " FROM " . $view . " a ";
$query .= " LEFT JOIN (SELECT cliente, SUM(IF(mantis=0,1,0)) qtd_erros, SUM(IF(mantis>0,1,0)) qtd_mantis, COUNT(*) qtd_total, COUNT(DISTINCT mantis) qtd_dist FROM logerro  ";
$query .= "             WHERE DATA >= '2017-06-01'  AND ip NOT IN (SELECT ip FROM cliente_ip_bloqueado) AND mantis NOT in ( select id FROM mantis.mantis_bug_table where status in (80,90)) GROUP BY cliente ) b ";
$query .= " ON a.id = b.cliente ";

$query .= " LEFT JOIN ( SELECT a.cliente, MAX(IF( a.modulo LIKE 'mcontas%',SUBSTR(a.modulo,8,8),'')) conpag, ";
$query .= "                               MAX(IF( a.modulo LIKE 'mfolha%' ,SUBSTR(a.modulo,7,8),'')) folha , ";
$query .= "                               MAX(IF( a.modulo LIKE 'mloca%'  ,SUBSTR(a.modulo,6,8),'')) loca  , ";
$query .= "                               MAX(IF( a.modulo LIKE 'mcondo%' ,SUBSTR(a.modulo,7,8),'')) condo , ";
$query .= "                               MAX(IF( a.modulo LIKE 'mfront%' ,SUBSTR(a.modulo,7,8),'')) front FROM cliente_log a WHERE a.ip NOT IN ( SELECT DISTINCT ip FROM cliente_ip_bloqueado ) GROUP BY a.cliente ) c ";
$query .= " ON a.id = c.cliente ";

$query .= " WHERE a.data = ( SELECT MAX(c.data) FROM " . $view . " c WHERE c.id = a.id GROUP BY c.id ) ";
$query .= " ORDER BY " . $ordem . ",1 ";
$result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . "<BR>" . $query );

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
       $outp .= '"id":"'         	     . $rs["id"]               . '",';
       $outp .= '"urlid":"'         	 . urlencode($rs["id"])    . '",';
       $outp .= '"versaobd":"'      	 . $rs["versaobd"]         . '",';
       $outp .= '"versaoso":"'    		 . $rs["versaoso"]         . '",';
       $outp .= '"bgcolor":"'    		 . $bgcolor                . '",';
       $outp .= '"usuario":"'   		 . $rs["usuario"]          . '",';
       $outp .= '"ip":"'   	    	     . $rs["ip"]               . '",';
       $outp .= '"data":"'    	         . $rs["data"]             . '",';
       $outp .= '"ult_atualizacao":"'    . $rs["ult_atualizacao"]  . '",';
       $outp .= '"conpag":"'             . $rs["conpag"]           . '",';
       $outp .= '"folha":"'              . $rs["folha"]            . '",';
       $outp .= '"loca":"'               . $rs["loca"]             . '",';
       $outp .= '"condo":"'              . $rs["condo"]            . '",';
       $outp .= '"front":"'              . $rs["front"]            . '",';
       $outp .= '"atuconpag":"'          . $rs["atuconpag"]        . '",';
       $outp .= '"atufolha":"'           . $rs["atufolha"]         . '",';
       $outp .= '"atuloca":"'            . $rs["atuloca"]          . '",';
       $outp .= '"atucondo":"'           . $rs["atucondo"]         . '",';
       $outp .= '"atufront":"'           . $rs["atufront"]         . '",';
       $outp .= '"atudb":"'              . $rs["atudb"]            . '",';
       $outp .= '"qtd_erros":"'   	     . $rs["qtd_erros"]        . '",';
       $outp .= '"qtd_mantis":"'   	     . $rs["qtd_mantis"]       . '",';
       $outp .= '"qtd_total":"'   	     . $rs["qtd_total"]        . '",';
       $outp .= '"qtd_dist":"'           . $rs["qtd_dist"]         . '"}';
}
$outp ='{"records":['.$outp.']}';
mysql_free_result($result);

echo($outp);

?>



 