<?php
session_start(); 
include("../library/funcoes.php");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 ";
};
$modo = $_REQUEST["mod"];

$lst = "'S'";
if ( strpos($_SESSION['acs'],"1") >= 1 ) { $lst = "'S','N'"; }

if ( $modo == "normal") { $lst = "'S'";}


$con = Conecta("site");

$query = "select * from modulo order by id";
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con));
$strMOD= array();
while ($rs = mysqli_fetch_assoc($result)) {
	$strMOD[$rs["id"]] =  $rs["versao"];
}


$con = Conecta("sac");

$view  = " ( SELECT a.id, a.conpag, a.folha, a.condo, a.front, a.locacao, a.ativo, c.versaobd, b.data, c.versaoso, c.usuario, c.ip, c.ult_atualizacao ";
$view .= " FROM cliente_sistemas a  ";
$view .= " LEFT JOIN ( SELECT aa.id,MAX(aa.DATA) DATA ";
$view .= "             FROM cliente_dados aa  ";
$view .= "             INNER JOIN cliente_ip_habilitado bb ON aa.id = bb.id AND aa.ip = bb.ip  ";
$view .= "            GROUP BY aa.id ) b ON a.id = b.id ";
$view .= " LEFT JOIN cliente_dados c ON a.id = c.id AND b.data = c.data ";
$view .= " WHERE a.ativo IN (" . $lst . ") )";


$query  = " SELECT replace(a.id,char(34),'`') id, a.versaobd, a.versaoso,  a.ip, a.data, a.ult_atualizacao, b.qtd_erros, b.qtd_mantis, b.qtd_total, if( b.qtd_erros > 0 ,b.qtd_dist-1,b.qtd_dist) as qtd_dist, ";
$query .= "        c.conpag, c.folha, c.loca, c.condo, c.front, " ;
$query .= "        if( c.conpag = '" . $strMOD[4] . "',1,0) as atuconpag, if( c.folha = '" . $strMOD[12] . "',1,0) as atufolha, if( c.loca ='" . $strMOD[10] . "',1,0) as atuloca, ";
$query .= "        if( c.condo = '" . $strMOD[3] . "',1,0) as atucondo, if( c.front = '" . $strMOD[9] . "',1,0) as atufront, if( a.ult_atualizacao = '" . $strMOD[13] . "',1,0) as atudb, ";
$query .= "        a.conpag as vwcpg, a.folha as vwflh, a.condo as vwcnd, a.locacao as vwlcc, a.front as vwfrn, a.ativo as vwcli ";
$query .= " FROM " . $view . " a ";
$query .= " LEFT JOIN ( SELECT a.cliente, SUM(IF(a.mantis=0,1,0)) qtd_erros, SUM(IF(a.mantis>0,1,0)) qtd_mantis, COUNT(*) qtd_total, COUNT(DISTINCT a.mantis) qtd_dist FROM logerro a ";
$query .= "             INNER JOIN cliente_ip_habilitado b ON a.cliente = b.id AND a.ip = b.ip ";
$query .= " WHERE a.DATA >= '2017-06-01' AND a.mantis NOT in ( select id FROM mantis.mantis_bug_table where status in (80,90)) GROUP BY cliente ) b ";
$query .= " ON a.id = b.cliente ";

$query .= " LEFT JOIN ( SELECT a.cliente, MAX(IF( a.modulo LIKE 'mcontas%',SUBSTR(a.modulo,8,8),'')) conpag, ";
$query .= "                               MAX(IF( a.modulo LIKE 'mfolha%' ,SUBSTR(a.modulo,7,8),'')) folha , ";
$query .= "                               MAX(IF( a.modulo LIKE 'mloca%'  ,SUBSTR(a.modulo,6,8),'')) loca  , ";
$query .= "                               MAX(IF( a.modulo LIKE 'mcondo%' ,SUBSTR(a.modulo,7,8),'')) condo , ";
$query .= "                               MAX(IF( a.modulo LIKE 'mfront%' ,SUBSTR(a.modulo,7,8),'')) front FROM cliente_log a ";
$query .= " INNER JOIN cliente_ip_habilitado b ON a.cliente = b.id AND a.ip = b.ip GROUP BY a.cliente ) c ";
$query .= " ON a.id = c.cliente ";

$query .= " ORDER BY a.ativo desc," . $ordem . ",1 ";
$result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query );

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
       $outp .= '"habconpag":"'          . $rs["vwcpg"]            . '",';
       $outp .= '"habfolha":"'           . $rs["vwflh"]            . '",';
       $outp .= '"habloca":"'            . $rs["vwlcc"]            . '",';
       $outp .= '"habcondo":"'           . $rs["vwcnd"]            . '",';
       $outp .= '"habfront":"'           . $rs["vwfrn"]            . '",';
       $outp .= '"habcliente":"'         . $rs["vwcli"]            . '",';
       $outp .= '"qtd_erros":"'   	     . $rs["qtd_erros"]        . '",';
       $outp .= '"qtd_mantis":"'   	     . $rs["qtd_mantis"]       . '",';
       $outp .= '"qtd_total":"'   	     . $rs["qtd_total"]        . '",';
       $outp .= '"qtd_dist":"'           . $rs["qtd_dist"]         . '"}';
}
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

echo($outp);
 
?>



 