<?
ini_set('default_charset','iso-8859-1');
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { ?> <script> parent.window.location.href ="UnionMnuVert.php" </script> <? }

include("data/conecta3307.php");


$id = urldecode($_REQUEST["id"]);
$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { $ordem = "1 desc"; };
$limit = $_REQUEST["lim"];
if ($limit == "" ) { $limit = "400"; };

?>

<html>
<head>
<title>Atendimentos dos Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

</head>

<body>
<div ng-app="myApp" class="w3-container">

<a href="javascript:history.go(-1)">
<div class="w3-padding w3-large w3-text-black">
    <i class="material-icons w3-xlarge" title="Voltar">home</i>
</div>
</a>

<div ng-controller="Erros">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Atendimentos ] <? echo $id ?> </em></b></font></td>
  </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center">Nº</td>
    <td width="05%" align="center">ID     <br><a href="VerCliente.php?id=<? echo $id ?>&ord=1"><i class="fa fa-caret-up" <? if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=1 desc"><i class="fa fa-caret-down" <? if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="08%" align="center">Motivo <br><a href="VerCliente.php?id=<? echo $id ?>&ord=2"><i class="fa fa-caret-up" <? if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=2 desc"><i class="fa fa-caret-down" <? if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="08%" align="center">Sistema <br><a href="VerCliente.php?id=<? echo $id ?>&ord=3"><i class="fa fa-caret-up" <? if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=3 desc"><i class="fa fa-caret-down" <? if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="25%" align="center">Descrição <br><a href="VerCliente.php?id=<? echo $id ?>&ord=4"><i class="fa fa-caret-up" <? if ( $ordem == '4' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=4 desc"><i class="fa fa-caret-down" <? if ( $ordem == '4 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">Programa <br><a href="VerCliente.php?id=<? echo $id ?>&ord=5"><i class="fa fa-caret-up" <? if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=5 desc"><i class="fa fa-caret-down" <? if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="10%" align="center">Data <br><a href="VerCliente.php?id=<? echo $id ?>&ord=6"><i class="fa fa-caret-up" <? if ( $ordem == '6' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=6 desc"><i class="fa fa-caret-down" <? if ( $ordem == '6 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="11%" align="center">Contato <br><a href="VerCliente.php?id=<? echo $id ?>&ord=7"><i class="fa fa-caret-up" <? if ( $ordem == '7' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=7 desc"><i class="fa fa-caret-down" <? if ( $ordem == '7 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="08%" align="center">Telefone <br><a href="VerCliente.php?id=<? echo $id ?>&ord=8"><i class="fa fa-caret-up" <? if ( $ordem == '8' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=8 desc"><i class="fa fa-caret-down" <? if ( $ordem == '8 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="08%" align="center">Analista <br><a href="VerCliente.php?id=<? echo $id ?>&ord=9"><i class="fa fa-caret-up" <? if ( $ordem == '9' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=9 desc"><i class="fa fa-caret-down" <? if ( $ordem == '9 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="10%" align="center">Email <br><a href="VerCliente.php?id=<? echo $id ?>&ord=10"><i class="fa fa-caret-up" <? if ( $ordem == '10' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=10 desc"><i class="fa fa-caret-down" <? if ( $ordem == '10 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">MANTIS <br><a href="VerCliente.php?id=<? echo $id ?>&ord=11"><i class="fa fa-caret-up" <? if ( $ordem == '11' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerCliente.php?id=<? echo $id ?>&ord=11 desc"><i class="fa fa-caret-down" <? if ( $ordem == '11 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
  </tr>

  <tr ng-repeat="x in names"> 
    <td width="02%" align="center"  > {{ x.cnt }}               </td>
    <td width="05%" align="center"  > <a href="VerChamado.php?id={{ x.id }}&pgm=VerCliente.php?id={{ x.razao }}"> {{ x.id }} </a> <br> <span ng-if=" x.qtanexo > 0 " >{{ x.qtanexo }} <img src='image/clips.jpg'></span></td>
	<td width="08%" align="center"  > {{ x.motivo }}            </td>
    <td width="08%" align="center"  > {{ x.sistema }}           </td>
    <td width="25%" align="center"  > {{ x.descricao }}         </td>
    <td width="05%" align="center"  > {{ x.programa }}          </td>
    <td width="10%" align="center"  > {{ x.datahora_cadastro }} </td>
    <td width="11%" align="center"  > {{ x.nome_contato }}      </td>
    <td width="08%" align="center"  > {{ x.fone_contato }}      </td>
    <td width="08%" align="center"  > {{ x.analista }}          </td>
    <td width="10%" align="center"  > {{ x.email_contato }}     </td>

    <td width='05%' align='center' title='{{ x.labelBR }}'  bgcolor='{{ x.color }}'> 
	   <span ng-if=" x.mantis !=  0 "><a href='http://uniondata.com.br/cliente/mantisbt/view.php?id={{ x.mantis }}' target='_blank'> {{ x.mantis }} <span ng-if=" x.verexe != '00.00.00' "><br>v.{{ x.verexe }}</span></a></span>
  	   <span ng-if=" x.mantis ==  0 "><span title='sem MANTIS' class='w3-badge   w3-red'>{{ x.mantis }}</span>
    </td>
	
  </tr>

</table>
</div>
<br>
<br>
<script>
var app = angular.module('myApp', []);
app.controller('Erros', function($scope, $http) {
   $http.get("data/dados_SEL_vercliente.php?id=<? echo $id ?>&ord=<? echo $ordem ?>&lim=<? echo $limit ?>")
   .then(function (response) {$scope.names = response.data.records;});
});

</script>


</body>
</html>

