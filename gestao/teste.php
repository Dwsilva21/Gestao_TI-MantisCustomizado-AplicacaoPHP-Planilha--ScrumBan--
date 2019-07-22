<?
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { ?> <script> parent.window.location.href ="UnionMnuVert.php" </script> <? }


$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "5 desc";
};

?>

<html>
<head>
<title>Atualização de Dados dos Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

</head>

<div class="w3-container">

	<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
		<tr class="w3-light-grey">
			<td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Atualizações/Erros</em></b></font></td>
		</tr>
	</table>

	<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar Cliente.." id="myInput" onkeyup="myFunction()">
</div>

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

<div ng-app="myApp" class="w3-container" >

   <div ng-controller="customersCtrl">

		<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable " id="myTable">
			<tr bgcolor="#5555FF" class="w3-green"> 
				<td width="02%" align="center"><b>Nº</b></td>
				<td width="28%" align="center">Cliente <br><a href="VerCli.php?ord=1"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=1 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
				<td width="15%" align="center">Versão BD <br><a href="VerCli.php?ord=2"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=2 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
				<td width="10%" align="center">Versão SO <br><a href="VerCli.php?ord=3"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=3 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
				<td width="10%" align="center">IP <br><a href="VerCli.php?ord=4"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=4 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
				<td width="13%" align="center">Data <br><a href="VerCli.php?ord=5"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=5 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
				<td width="10%" align="center">Atualização <br><a href="VerCli.php?ord=6"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=6 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
				<td width="12%" align="center">Qtd. Erros <br><a href="VerCli.php?ord=9"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerCli.php?ord=9 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
			</tr>
 
			<tr ng-repeat="x in names"> 
  
  
				<td width="02%" align="center" bgcolor="{{x.bgcolor}}"> {{ x.cnt }} </td>
	
				<td width="28%" align="center" > {{ x.id }} </td>
	
				<td width="15%" align="center" > {{ x.versaobd }} </td>
	
				<td width="10%" align="center" > {{ x.vSO  }} </td>
	
				<td width="10%" align="center" > {{ x.ip }} </td>
	
				<td width="13%" align="center" > {{ x.data }} </td>
	
				<td width="10%" align="center" > {{ x.ult_atualizacao }} </td>
	  
				<td width="12%" align="center" > 
					<span ng-if=" x.qtd_erros > 0 "><a href="VerErros.php?id={{ x.id }}"><span title="sem MANTIS" class="w3-badge w3-red">{{ x.qtd_erros }}</span></a></span>
					<span ng-if=" x.qtd_erros > 0 && x.qtd_mantis > 0">+</span>
					<span ng-if=" x.qtd_mantis > 0 "><a href="VerErros.php?id={{ x.id }}"><span title="em {{ x.qtd_dist-1 }} MANTIS" class="w3-badge w3-green">{{ x.qtd_mantis }}</span></a></span>
					<span ng-if=" x.qtd_erros > 0 && x.qtd_mantis > 0 ">={{ x.qtd_total }}</span>
	  
				</td>

			</tr>

		</table>
		
	</div>
	
   <br>
	
   <div class="w3-container" ng-controller="Resumo" width="30%" >

		<table border="0" width="30%" cellspacing="3" cellpadding="4" class="w3-table-all">

			<tr bgcolor="#5555FF"  > 
				<td width="50%" align="center">Versão BD</td>
				<td width="50%" align="center">Qtde</td>
			</tr>

			<tr ng-repeat="y in names"> 
				<td width="50%" align="center" bgcolor="{{ y.bgcolor }}"> {{ y.versaobd }}</td>
				<td width="50%" align="center" > {{ y.qtde }}</td>
			</tr>

		</table>
		
   </div>
	
</div>	

<br>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get("data/dados_SEL_vercli.php?ord=<? echo $ordem ?>")
   .then(function (response) {$scope.names = response.data.records;});
});
app.controller('Resumo', function($scope, $http) {
   $http.get("data/dados_SEL_vercliresumo.php")
   .then(function (response) {$scope.names = response.data.records;});
   
});
</script>

</body>
</html>

