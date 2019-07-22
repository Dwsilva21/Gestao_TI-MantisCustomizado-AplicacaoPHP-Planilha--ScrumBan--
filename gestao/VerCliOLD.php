<?
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { ?> <script> parent.window.location.href ="UnionMnuVert.php" </script> <? }

include("data/conecta3307.php");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "5 desc";
};
$view   = "( SELECT x.id,x.versaobd,x.data ,x.versaoso,x.usuario,x.ip,x.ult_atualizacao FROM cliente_dados x LEFT JOIN cliente_ip_bloqueado y ON x.ip = y.ip WHERE y.ip IS NULL ) ";
$query  = "SELECT a.id, a.versaobd, a.versaoso,  a.ip, a.data, a.ult_atualizacao, b.qtd_erros, b.qtd_mantis, b.qtd_total, b.qtd_dist ";
$query .= " FROM " . $view . " a ";
$query .= " LEFT JOIN (SELECT cliente, SUM(IF(mantis=0,1,0)) qtd_erros, SUM(IF(mantis>0,1,0)) qtd_mantis, COUNT(*) qtd_total, COUNT(DISTINCT mantis) qtd_dist FROM logerro WHERE DATA >= '2017-06-01'  AND ip NOT IN (SELECT ip FROM cliente_ip_bloqueado) GROUP BY cliente ) b ";
$query .= " ON a.id = b.cliente ";
$query .= " WHERE a.data = ( SELECT MAX(c.data) FROM " . $view . " c WHERE c.id = a.id GROUP BY c.id ) ";
$query .= " ORDER BY " . $ordem . ",1";
$result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . $query );
?>

<html>
<head>
<title>Atualização de Dados dos Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="sortcut icon" href="images/favicon.ico" type="image/x-icon" />

</head>

<div class="w3-container">
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Atualizações/Erros</em></b></font></td>
  </tr>
</table>

<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar Cliente.." id="myInput" onkeyup="myFunction()">

</div>

<div ng-app="myApp" >

<div class="w3-container" ng-controller="Clientes">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable " id="myTable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="28%" align="center">Cliente <br><a href="VerCli.php?ord=1"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=1 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="15%" align="center">Vers&atilde;o BD <br><a href="VerCli.php?ord=2"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=2 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Vers&atilde;o SO <br><a href="VerCli.php?ord=3"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=3 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">IP <br><a href="VerCli.php?ord=4"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=4 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="13%" align="center">Data <br><a href="VerCli.php?ord=5"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=5 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Atualização <br><a href="VerCli.php?ord=6"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=6 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="12%" align="center">Qtd. Erros <br><a href="VerCli.php?ord=9"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=9 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
  </tr>
  <? 
    $cnt = 0;
	while ($arr = mysql_fetch_assoc($result)) {
	   $vBD  = $arr["versaobd"];
	   $vSO  = $arr["versaoso"];
	   if (strpos($vBD,"-nt") > 0) {
	      if ($vSO == "") {
		     $vSO = "Windows";
		  };
	   }; 
	   $cnt = $cnt + 1;
	   
	   $bgcolor = "#BDE2FF";
       if (substr($vBD,0,1) == "4") { $bgcolor = "#FF0000"; }	  
  ?>
  <tr > 
    <td width="02%" align="center" <?  echo " bgcolor ='" . $bgcolor . "' ";  ?> > 
      <? echo $cnt; ?>
      </td>
    <td width="28%" align="center" > 
      <? echo $arr["id"]; ?>
      </td>
    <td width="15%" align="center" > 
      <? echo $arr["versaobd"]; ?>
      </td>
    <td width="10%" align="center" > 
      <? echo $vSO; ?>
      </td>
    <td width="10%" align="center" > 
      <? echo $arr["ip"];  
	    if ( $arr["ip"] <> "" ) {
        # $dados = file_get_contents('http://freegeoip.net/json/'.$arr["ip"]);
		# $parsedJson  = json_decode($dados);
        # {
        #    echo "<BR>".htmlspecialchars($parsedJson->region_name).', '.$parsedJson->region_code;
        # } ;
		};
      ?>	  
      </font></td>
    <td width="13%" align="center" > 
      <? echo $arr["data"]; ?>
      </td>
    <td width="10%" align="center" > 
      <? echo $arr["ult_atualizacao"]; ?>
      </td>
	  
    <td width="12%" align="center" > 
      <a href="VerErros.php?id=<? echo $arr["id"]; ?>"><span title="sem MANTIS" class="w3-badge   w3-red"><? if ( $arr["qtd_erros"] > 0  ) { echo $arr["qtd_erros"]; } ?></span></a>
	  <? if ( $arr["qtd_erros"] > 0 && $arr["qtd_mantis"] > 0 ) { echo "+"; } ?>
	  <a href="VerErros.php?id=<? echo $arr["id"]; ?>"><span title="em <? if ( $arr["qtd_erros"] > 0 ) { echo $arr["qtd_dist"]-1; } else { echo $arr["qtd_dist"]; } ?> MANTIS" class="w3-badge w3-green"><? if ( $arr["qtd_mantis"] > 0  ) { echo $arr["qtd_mantis"]; } ?></span></a>
	  <? if ( $arr["qtd_erros"] > 0 && $arr["qtd_mantis"] > 0 ) { echo "="; echo $arr["qtd_total"]; } ?> 
      </td>

	  </tr>
  <? 
  }
  ?>
</table>
</div>

<br>
<div class="w3-container" width="30%">

<table border="0" width="30%" cellspacing="3" cellpadding="4" class="w3-table-all">
  <tr bgcolor="#5555FF"  > 
    <td width="50%" align="center">Versão BD</td>
    <td width="50%" align="center">Qtde</td>
  </tr>

  <? 
  $query = "SELECT  left(a.versaobd,1) as versaobd, count(*) as qtde FROM " . $view . " a WHERE a.data = ( SELECT MAX(b.data) FROM " . $view . " b WHERE b.id = a.id GROUP BY b.id ) GROUP BY left(a.versaobd,1) ORDER BY left(a.versaobd,1)";
  $result = mysql_query($query) or die("A consulta falhou : " . mysql_error());
  
  while ($arr = mysql_fetch_assoc($result)) {  
  
     $vBD  = $arr["versaobd"];
     $bgcolor = "#BDE2FF";
     if (substr($vBD,0,1) == "4") { $bgcolor = "#FF0000"; }	  
	 
  ?>
    <tr> 
      <td width="50%" align="center" bgcolor="<? echo $bgcolor ?>"> 
        <? echo $arr["versaobd"]; ?>
        </td>
      <td width="50%" align="center" > 
        <? echo $arr["qtde"]; ?>
        </td>
    </tr>
  <? 
  }
  ?>
</table>
</div>

 
  <? 
  mysql_free_result($result);
  ?>
  
<br>

<script>
var app = angular.module('myApp', []);
app.controller('Clientes', function($scope, $http) {
   $http.get("data/dados_SEL_vercli.php?ord=<? echo $ordem ?>")
   .then(function (response) {$scope.names = response.data.records;});
   
});
</script>


<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
	
    if (td) {
   	  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

</body>
</html>

