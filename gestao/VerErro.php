<?
ini_set('default_charset','iso-8859-1');
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { header ( 'Location: UnionMnuVert.php' );  }

$sis = $_REQUEST["sis"];
$pro = $_REQUEST["pro"];
$rot = $_REQUEST["rot"];
$lin = $_REQUEST["lin"];
$num = $_REQUEST["num"];
$des = $_REQUEST["des"];
$man = $_REQUEST["man"];

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "2 desc";
};
?>

<html>
<head>
<title>Erro</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>



</head>
<a href="VerErrosMantis.php">

<div class="w3-container">

<div class="w3-padding w3-large w3-text-black">
    <i class="material-icons w3-xlarge" title="Voltar">home</i>
</div>
</a>


  
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Erro ] <? echo $des ?></em></b></font></td>
  </tr>
</table>

<br> 

<div ng-app="myApp">
<div class="w3-container w3-tiny w3-text-green" >


  <div class="w3-half w3-row-padding" >	
    <label><b>Sistema</b></label>
    <input class="w3-input w3-border w3-light-gray" name="sistema" type="text" disabled value="<? echo $sis ?>">
  </div>	
  <div class="w3-half w3-row-padding" >	
    <label><b>Programa</b></label>
    <input class="w3-input w3-border w3-light-gray" name="programa" type="text" disabled value="<? echo $pro ?>">
  </div>	
  <div class="w3-third w3-row-padding" >
    <label><b>Rotina</b></label>
    <input class="w3-input w3-border w3-light-gray" name="rotina" type="text" disabled value="<? echo $rot ?>">
  </div>	
  <div class="w3-third w3-row-padding" >
    <label><b>Linha</b></label>
    <input class="w3-input w3-border w3-light-gray" name="linha" type="text" disabled value="<? echo $lin ?>">
  </div>	
  <div class="w3-third w3-row-padding" >	
    <label><b>Número</b></label>
    <input class="w3-input w3-border w3-light-gray" name="numero" type="text" disabled value="<? echo $num ?>">
  </div>	
  <div class="w3-row-padding" >	
    <label><b>Descrição</b></label>
    <input class="w3-input w3-border w3-light-gray" name="descricao" type="text" disabled value="<? echo $des ?>">
  </div>	
  
  
</div>


<br>

<div class="w3-container w3-tiny w3-text-green" ng-controller="Erro">


<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center">Nº</td>
    <td width="23%" align="center">Cliente <br><a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=1"><i class="fa fa-caret-up" <? if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a><a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=1 desc"><i class="fa fa-caret-down" <? if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="15%" align="center">Versão <br><a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=10"><i class="fa fa-caret-up" <? if ( $ordem == '10' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=10 desc"><i class="fa fa-caret-down" <? if ( $ordem == '10 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="15%" align="center">Data Hora <br><a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=2"><i class="fa fa-caret-up" <? if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=2 desc"><i class="fa fa-caret-down" <? if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="15%" align="center">Usuário <br><a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=3"><i class="fa fa-caret-up" <? if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=3 desc"><i class="fa fa-caret-down" <? if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="15%" align="center">IP <br><a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=5"><i class="fa fa-caret-up" <? if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=5 desc"><i class="fa fa-caret-down" <? if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="15%" align="center">MANTIS <br><a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=6"><i class="fa fa-caret-up" <? if ( $ordem == '6' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErro.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=6 desc"><i class="fa fa-caret-down" <? if ( $ordem == '6 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
  </tr>
  
  <tr ng-repeat="y in names" class="w3-tiny"> 
    <td width="02%" align="center"  >  {{ y.cnt }} </td>
	
    <td width="23%" align="center"  >  {{ y.id }} </td>
	
    <td width="15%" align="center"  >  {{ y.versao }} </td>
 
    <td width="15%" align="center"  >  {{ y.datahora }} </td>
 
    <td width="15%" align="center"  >  {{ y.usuario }} </td>
	
    <td width="15%" align="center"  >  {{ y.ip}} </td>
	
    <td width="15%" align="center" title="{{y.labelBR}}"  bgcolor="{{y.color}}">
	  
  	  <a href="http://uniondata.com.br/cliente/mantisbt/view.php?id={{ y.mantis }}" target="_blank"> {{ y.mantis }} </a> 
	  
	</td>
	  
  </tr>
 
 </table>
</div>

</div>

<br>
 
 
<br>

<script>
var app = angular.module('myApp', []);
app.controller('Erro', function($scope, $http) {
   $http.get("data/dados_SEL_vererroocorrencias.php?sis=<? echo $sis ?>&pro=<? echo $pro ?>&rot=<? echo $rot ?>&lin=<? echo $lin ?>&num=<? echo $num ?>&ord=<? echo $ordem ?>")
   .then(function (response) {$scope.names = response.data.records;});
});
</script>


</body>
</html>

