<?
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { header ( 'Location: UnionMnuVert.php' );  }

$sis = $_REQUEST["sis"];
$mod = $_REQUEST["mod"];
$ver = $_REQUEST["ver"];

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "7 desc";
};
?>

<html>
<head>
<title>Versão</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.27/angular.min.js"></script>



</head>
<a href="VerVersoes.php">

<div class="w3-container">

<div class="w3-padding w3-large w3-text-black">
    <i class="material-icons w3-xlarge" title="Voltar">home</i>
</div>
</a>


  
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Versão ] <? echo $mod ?> <? echo $ver ?></em></b></font></td>
  </tr>
</table>

<br> 

<div ng-app="myApp">
<div class="w3-container w3-tiny w3-text-green" >


  <div class="w3-half w3-row-padding" >	
    <label><b>Módulo</b></label>
    <input class="w3-input w3-border w3-light-gray" name="modulo" type="text" disabled value="<? echo $mod ?>">
  </div>	
  <div class="w3-half w3-row-padding" >	
    <label><b>Versão</b></label>
    <input class="w3-input w3-border w3-light-gray" name="versao" type="text" disabled value="<? echo $ver ?>">
  </div>	
  
  
</div>


<br>

<div class="w3-container w3-tiny w3-text-green" ng-controller="Versao">

<p ng-bind="xml"></p>
		
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center">Nº</td>
    <td width="05%" align="center">Sistema <br><a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=1"><i class="fa fa-caret-up" <? if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a><a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=1 desc"><i class="fa fa-caret-down" <? if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="25%" align="center">Descrição <br><a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=2"><i class="fa fa-caret-up" <? if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=2 desc"><i class="fa fa-caret-down" <? if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="25%" align="center">Passos <br><a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=3"><i class="fa fa-caret-up" <? if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=3 desc"><i class="fa fa-caret-down" <? if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="25%" align="center">Adicional <br><a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=4"><i class="fa fa-caret-up" <? if ( $ordem == '4' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=4 desc"><i class="fa fa-caret-down" <? if ( $ordem == '4 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="13%" align="center">Data <br><a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=7"><i class="fa fa-caret-up" <? if ( $ordem == '7' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=7 desc"><i class="fa fa-caret-down" <? if ( $ordem == '7 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">MANTIS <br><a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=5"><i class="fa fa-caret-up" <? if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<? echo $sis ?>&mod=<? echo $mod ?>&ver=<? echo $ver ?>&ord=5 desc"><i class="fa fa-caret-down" <? if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
  </tr>
  
  <tr ng-repeat="y in names" class="w3-tiny"> 
    <td width="02%" align="center"  >  {{ y.dbupt }} </td>
	
    <td width="02%" align="center"  >  {{ y.versao }} </td>

    <td width="05%" align="center"  >  {{ y.sql }} </td>

	  
  </tr>
 
 </table>
</div>

</div>

<br>
 
 
<br>

<script>
(function() {
    var app = angular.module('myApp', []);
    app.controller('Controller', ['$scope', '$http', '$window', function($scope, $http, $window) {
        $scope.xml = '';
        $http({
            method  : 'GET',
            url     : 'http://www.uniondata.com.br/atualsis/dbupt.xml',
            timeout : 10000,
            params  : {},  // Query Parameters (GET)
            transformResponse : function(data) {
                // string -> XML document object
                return $.parseXML(data);
            }
        }).success(function(data, status, headers, config) {
            console.dir(data);  // XML document object
            $scope.xml = data.documentElement.innerHTML;
        }).error(function(data, status, headers, config) {
            $window.alert('?????????.');
        });
    }]);
})();
</script>


</body>
</html>

