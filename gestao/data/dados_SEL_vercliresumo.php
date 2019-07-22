<?php
session_start();
ini_set('default_charset','iso-8859-1');
include("../library/funcoes.php");
$con = Conecta("sac");


$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};


$view  = " ( SELECT a.id, a.conpag, a.folha, a.condo, a.front, a.locacao, b.versaobd, b.data, b.versaoso, b.usuario, b.ip, b.ult_atualizacao ";
$view .= "  FROM cliente_sistemas a ";
$view .= "  LEFT JOIN cliente_dados b ON a.id = b.id ";
$view .= " WHERE a.ativo = 'S' ";
$view .= "  AND b.data = (SELECT MAX(aa.DATA) FROM cliente_dados aa LEFT JOIN cliente_ip_bloqueado bb ON aa.ip = bb.ip WHERE aa.id=a.id AND bb.ip IS NULL ) )";


$query = "SELECT  left(a.versaobd,1) as versaobd, count(*) as qtde FROM " . $view . " a GROUP BY left(a.versaobd,1) ORDER BY left(a.versaobd,1)";


$query  = "SELECT  d.versaobd , COUNT(*) AS qtde";
$query .= " FROM cliente_sistemas a ";
$query .= " LEFT JOIN ( SELECT b.id, MAX(SUBSTR(b.versaobd,1,1)) versaobd FROM cliente_dados b INNER JOIN cliente_ip_habilitado c ON b.id=c.id AND b.ip=c.ip GROUP BY b.id ) d ";
$query .= "   ON a.id = d.id ";
$query .= "WHERE a.ativo = 'S' ";
$query .= "GROUP BY  1";
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . $query );

header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );

    $cnt = 0;
    $outp = "";	
	while ($rs = mysqli_fetch_assoc($result)) {
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
mysqli_free_result($result);

echo($outp);

?>



 