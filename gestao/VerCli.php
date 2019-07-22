<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "5 desc";
};
$modo = $_REQUEST["mod"];
$aaux = $_SESSION['acs'];
if ($modo == "normal" ) { 
    $_SESSION['acs'] = 999;
};


?>

<html>
<head>
<title>Atualização de Dados dos Clientes </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

</head>

<body>
<div class="w3-container">

<!--
	<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
		<tr class="w3-light-grey">
			<td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Atualizações/Erros</em></b></font>  </td>
		</tr>
	</table>
-->
	<a href="VerCli.php?mod=normal" title="Visão sem Botões"><i class="material-icons" style="font-size:28px;">pageview</i><a>
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

		<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny" id="myTable">
			<tr bgcolor="#5555FF" class="w3-green"> 
				<td width="02%" align="center"><b>Nº</b></td>
				<td width="20%" align="center">Cliente <br><a href="VerCli.php?ord=1"><i class="fa fa-caret-up" <?php if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=1 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="06%" align="center">Versão BD <br><a href="VerCli.php?ord=2"><i class="fa fa-caret-up" <?php if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=2 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="11%" align="center">Versão SO <br><a href="VerCli.php?ord=3"><i class="fa fa-caret-up" <?php if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=3 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="08%" align="center">IP <br><a href="VerCli.php?ord=4"><i class="fa fa-caret-up" <?php if ( $ordem == '4' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=4 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '4 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="13%" align="center">Data <br><a href="VerCli.php?ord=5"><i class="fa fa-caret-up" <?php if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=5 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="05%" align="center">Atualização BD<br><a href="VerCli.php?ord=6"><i class="fa fa-caret-up" <?php if ( $ordem == '6' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=6 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '6 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="05%" align="center">CONPAG <br><a href="VerCli.php?ord=11"><i class="fa fa-caret-up" <?php if ( $ordem == '11' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=11 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '11 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
			<!--	<td width="05%" align="center">FOLHA <br><a href="VerCli.php?ord=12"><i class="fa fa-caret-up"  if ( $ordem == '12' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=12 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '12 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td> !-->
				<td width="05%" align="center">LOCACAO <br><a href="VerCli.php?ord=13"><i class="fa fa-caret-up" <?php if ( $ordem == '13' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=13 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '13 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="05%" align="center">CONDO <br><a href="VerCli.php?ord=14"><i class="fa fa-caret-up" <?php if ( $ordem == '14' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=14 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '14 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="05%" align="center">FRONT <br><a href="VerCli.php?ord=15"><i class="fa fa-caret-up" <?php if ( $ordem == '15' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=15 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '15 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
				<td width="10%" align="center">Qtd. Erros <br><a href="VerCli.php?ord=9"><i class="fa fa-caret-up" <?php if ( $ordem == '9' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCli.php?ord=9 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '9 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
			</tr>
 
			<tr ng-repeat="x in names"> 
  
  
				<td width="02%" align="center" bgcolor="{{x.bgcolor}}"> {{ x.cnt }} </td>
	
				<td width="20%" align="center" >     
				    <a href="VerCliente.php?id={{ x.urlid }}"> {{ x.id }} </a>
				    <span ng-if=" <?php echo strpos($_SESSION['acs'],"1")  ;?> > 0 "> 
					   <a href="#">
					     <span ng-if=" x.habcliente == 'N' "><span ng-click="myAble( x.id,'TODOS',x.habcliente )" title="Ativar CLIENTE"    class="w3-tag w3-white w3-border w3-border-green w3-text-green">A</span></span>
					     <span ng-if=" x.habcliente == 'S' "><span ng-click="myAble( x.id,'TODOS',x.habcliente )" title="Desativar CLIENTE" class="w3-tag w3-white w3-border w3-border-red   w3-text-red"  >X</span></span>
					   </a>
					</span>
				</td>
	
				<td width="06%" align="center" > {{ x.versaobd }} </td>
	
				<td width="11%" align="center" > {{ x.versaoso }} </td>
	
				<td width="08%" align="center" > {{ x.ip }} </td>
	
				<td width="13%" align="center" > {{ x.data }} </td>
	
				<td width="05%" align="center" > 
				    <span ng-if=" x.atudb == 0 "><span title="BD Versão Desatualizada" class="w3-badge w3-red">{{ x.ult_atualizacao }} </span></span>
				    <span ng-if=" x.atudb == 1 ">{{ x.ult_atualizacao }} </span> 
				</td>


				<td width="05%" align="center" >   
				       <span ng-if=" x.atuconpag == 0 "><span title="CONPAG Versão Desatualizada" class="w3-badge w3-red"><span ng-if=" x.habconpag == 'S' ">{{ x.conpag }}</span></span></span>
				       <span ng-if=" x.atuconpag == 1 "><span ng-if=" x.habconpag == 'S' ">{{ x.conpag }}</span></span>  
				       <span ng-if=" <?php echo strpos($_SESSION['acs'],"1")  ;?> > 0 && x.habcliente == 'S' "><br>
					      <a href="#">
					        <span ng-if=" x.habconpag == 'N' "><span ng-click="myAble( x.id,'CONPAG',x.habconpag )" title="Ativar CONPAG"    class="w3-tag w3-white w3-border w3-border-green w3-text-green">A</span></span>
					        <span ng-if=" x.habconpag == 'S' "><span ng-click="myAble( x.id,'CONPAG',x.habconpag )" title="Desativar CONPAG" class="w3-tag w3-white w3-border w3-border-red   w3-text-red"  >X</span></span>
					      </a>
					   </span>
                </td>
				
			<!--	<td width="05%" align="center" >   
				       <span ng-if=" x.atufolha == 0 "><span title="FOLHA Versão Desatualizada" class="w3-badge w3-red"><span ng-if=" x.habfolha == 'S' ">{{ x.folha }}</span></span></span>
				       <span ng-if=" x.atufolha == 1 "><span ng-if=" x.habfolha == 'S' ">{{ x.folha }}</span></span>  
				       <span ng-if=" <?php echo strpos($_SESSION['acs'],"1")  ;?> > 0 && x.habcliente == 'S' "><br>
					      <a href="#">
					        <span ng-if=" x.habfolha == 'N' "><span ng-click="myAble( x.id,'FOLHA',x.habfolha )" title="Ativar FOLHA"    class="w3-tag w3-white w3-border w3-border-green w3-text-green">A</span></span>
					        <span ng-if=" x.habfolha == 'S' "><span ng-click="myAble( x.id,'FOLHA',x.habfolha )" title="Desativar FOLHA" class="w3-tag w3-white w3-border w3-border-red   w3-text-red"  >X</span></span>
					      </a>
					   </span>
                </td>
			!-->	
				<td width="05%" align="center" >   
				       <span ng-if=" x.atuloca == 0 "><span title="LOCACAO Versão Desatualizada" class="w3-badge w3-red"><span ng-if=" x.habloca == 'S' ">{{ x.loca }}</span></span></span>
				       <span ng-if=" x.atuloca == 1 "><span ng-if=" x.habloca == 'S' ">{{ x.loca }}</span></span>  
				       <span ng-if=" <?php echo strpos($_SESSION['acs'],"1")  ;?> > 0 && x.habcliente == 'S' "><br>
					      <a href="#">
					        <span ng-if=" x.habloca == 'N' "><span ng-click="myAble( x.id,'LOCACAO',x.habloca )" title="Ativar LOCACAO"    class="w3-tag w3-white w3-border w3-border-green w3-text-green">A</span></span>
					        <span ng-if=" x.habloca == 'S' "><span ng-click="myAble( x.id,'LOCACAO',x.habloca )" title="Desativar LOCACAO" class="w3-tag w3-white w3-border w3-border-red   w3-text-red"  >X</span></span>
					      </a>
					   </span>
                </td>
				<td width="05%" align="center" >   
				       <span ng-if=" x.atucondo == 0 "><span title="CONDO Versão Desatualizada" class="w3-badge w3-red"><span ng-if=" x.habcondo == 'S' ">{{ x.condo }}</span></span></span>
				       <span ng-if=" x.atucondo == 1 "><span ng-if=" x.habcondo == 'S' ">{{ x.condo }}</span></span>  
				       <span ng-if=" <?php echo strpos($_SESSION['acs'],"1")  ;?> > 0 && x.habcliente == 'S' "><br>
					      <a href="#">
					        <span ng-if=" x.habcondo == 'N' "><span ng-click="myAble( x.id,'CONDO',x.habcondo )" title="Ativar CONDO"    class="w3-tag w3-white w3-border w3-border-green w3-text-green">A</span></span>
					        <span ng-if=" x.habcondo == 'S' "><span ng-click="myAble( x.id,'CONDO',x.habcondo )" title="Desativar CONDO" class="w3-tag w3-white w3-border w3-border-red   w3-text-red"  >X</span></span>
					      </a>
					   </span>
                </td>
				<td width="05%" align="center" >   
				       <span ng-if=" x.atufront == 0 "><span title="FRONT Versão Desatualizada" class="w3-badge w3-red"><span ng-if=" x.habfront == 'S' ">{{ x.front }}</span></span></span>
				       <span ng-if=" x.atufront == 1 "><span ng-if=" x.habfront == 'S' ">{{ x.front }}</span></span>  
				       <span ng-if=" <?php echo strpos($_SESSION['acs'],"1")  ;?> > 0 && x.habcliente == 'S' "><br>
					      <a href="#">
					        <span ng-if=" x.habfront == 'N' "><span ng-click="myAble( x.id,'FRONT',x.habfront )" title="Ativar FRONT"    class="w3-tag w3-white w3-border w3-border-green w3-text-green">A</span></span>
					        <span ng-if=" x.habfront == 'S' "><span ng-click="myAble( x.id,'FRONT',x.habfront )" title="Desativar FRONT" class="w3-tag w3-white w3-border w3-border-red   w3-text-red"  >X</span></span>
					      </a>
					   </span>
                </td>
			


				
				<td width="10%" align="center" > 
					<span ng-if=" x.qtd_erros > 0 "><a ng-href="VerErros.php?id={{ x.urlid }}"><span title="sem MANTIS" class="w3-badge w3-red">{{ x.qtd_erros }}</span></a></span>
					<span ng-if=" x.qtd_erros > 0 && x.qtd_mantis > 0">+</span>
					<span ng-if=" x.qtd_mantis > 0 "><a ng-href="VerErros.php?id={{ x.urlid }}"><span title="em {{ x.qtd_dist }} MANTIS" class="w3-badge w3-green">{{ x.qtd_mantis }}</span></a></span>
					<span ng-if=" x.qtd_erros > 0 && x.qtd_mantis > 0 ">={{ x.qtd_total }}</span>
	  
				</td>

			</tr>

		</table>
		
	</div>
	
	
    <div ng-controller="Totais">
		<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-tiny">
			<tr ng-repeat="z in names" class="w3-yellow"> 
				<td width="02%" align="center"><b></b></td>
				<td width="20%" align="center">Total [Ativos]</td>
				<td width="11%" align="center" title="Qtde" > {{ z.qtde }}</td>
				<td width="11%" align="center"></td>
				<td width="08%" align="center"></td>
				<td width="08%" align="center"></td>
				<td width="05%" align="center"></td>
				<td width="05%" align="center" title="Total CONPAG" > {{ z.conpag }}</td>
			<!--	<td width="05%" align="center" title="Total FOLHA" >  {{ z.folha  }}</td> !-->
				<td width="05%" align="center" title="Total LOCACAO" >{{ z.loca   }}</td>
				<td width="05%" align="center" title="Total CONDO" >  {{ z.condo  }}</td>
				<td width="05%" align="center" title="Total FRONT" >  {{ z.front  }}</td>
				<td width="10%" align="center"></td>
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


   $scope.myAble = function($pid,$psis,$psta) {
      var txt;
      var txt2;
	  if ( $psta == "S" ){ txt2 = 'DESATIVAÇÃO'; } else {txt2 = 'ATIVAÇÃO'; }
	  
      var r = confirm('Confirma ' + txt2 + ' do Sistema/Cliente :\n ' + $psis + '\n' + $pid);
      if (r == true) {
         window.open('data/dados_REP_clientesistemaBloq.php?sis=' + $psis + '&id=' + $pid.replace("&","^") + '&sta=' + $psta,"iframe_a");
      }	  
      return $scope.firstName = 'Able : ' + $pid;
   };

   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_vercli.php?ord=<?php echo $ordem ?>&mod=<?php echo $modo ?>")
        .then(function (response) {$scope.names = response.data.records;});
   };
   $scope.atualiza();
   
});   
</script>
	

<script>
app.controller('Resumo', function($scope, $http) {
   
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_vercliresumo.php")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();
   
   
});

app.filter('myFormat', function() { return function(x) { return decodeURIComponent(x);  }; });

app.filter('escape', function(i) {   return window.decodeURIComponent; });


</script>

<script>
app.controller('Totais', function($scope, $http) {

   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_verclitot.php")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();

   
});

</script>

<?php
if ($modo == "normal" ) { 
    $_SESSION['acs'] = $aaux;
};
?>


</body>
</html>

