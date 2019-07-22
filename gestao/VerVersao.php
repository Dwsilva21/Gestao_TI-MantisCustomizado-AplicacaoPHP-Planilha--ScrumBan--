<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}

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

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>



</head>
<a href="javascript: history.go(-1);">

<div class="w3-container">

<div class="w3-padding w3-large w3-text-black">
    <i class="material-icons w3-xlarge" title="Voltar">home</i>
</div>
</a>


  
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Versão ] <?php echo $mod ?> <?php echo $ver ?></em></b></font></td>
  </tr>
</table>

<br> 

<div ng-app="myApp">
<div class="w3-container w3-tiny w3-text-green" >


  <div class="w3-half w3-row-padding" >	
    <label><b>Módulo</b></label>
    <input class="w3-input w3-border w3-light-gray" name="modulo" type="text" disabled value="<?php echo $mod ?>">
  </div>	
  <div class="w3-half w3-row-padding" >	
    <label><b>Versão</b></label>
    <input class="w3-input w3-border w3-light-gray" name="versao" type="text" disabled value="<?php echo $ver ?>">
  </div>	
  
  
</div>


<br>

<div class="w3-container w3-tiny w3-text-green" ng-controller="Versao">


<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center">Nº</td>
    <td width="05%" align="center">Sistema <br><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=1"><i class="fa fa-caret-up" <?php if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=1 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="25%" align="center">Descrição <br><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=2"><i class="fa fa-caret-up" <?php if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=2 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">Tipo <br><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=2"><i class="fa fa-caret-up" <?php if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=2 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="25%" align="center">Passos <br><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=3"><i class="fa fa-caret-up" <?php if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=3 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="20%" align="center">Adicional <br><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=4"><i class="fa fa-caret-up" <?php if ( $ordem == '4' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=4 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '4 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="13%" align="center">Data <br><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=7"><i class="fa fa-caret-up" <?php if ( $ordem == '7' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=7 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '7 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">MANTIS <br><a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=5"><i class="fa fa-caret-up" <?php if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=5 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
  </tr>
  
  <tr ng-repeat="y in names" class="w3-tiny"> 
    <td width="02%" align="center"  >  {{ y.cnt }} </td>
	
    <td width="05%" align="center"  >  <span ng-bind-html="y.sistema | trustAs"> </span>  </td>

    <td width="25%" align="center"  >  <span ng-bind-html="y.descricao | trustAs"> </span> </td>
 
    <td width="05%" align="center"  >  {{ y.tipo}} </td>

    <td width="25%" align="center"  >  <span ng-bind-html="y.passos | trustAs"> </span>  </td>
	
    <td width="20%" align="center"  >  <span ng-bind-html="y.clientes | trustAs"> </span>  </td>

    <td width="13%" align="center"  >  {{ y.data }} </td>

    <td width="05%" align="center" title="{{y.labelBR}}"  bgcolor="{{y.color}}">
	  
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

app
.filter('trustAs', function($sce) {
        return function (input, type) {
            
                return $sce.trustAs(type || 'html', decodeURIComponent(input.replace(/\+/g, ' '))  );
            
        };
    })
	
.controller('Versao', function($scope, $http) {
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_verversao.php?sis=<?php echo $sis ?>&mod=<?php echo $mod ?>&ver=<?php echo $ver ?>&ord=<?php echo $ordem ?>")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();
   
   
});
</script>


</body>
</html>

