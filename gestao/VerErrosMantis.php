<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "9 desc";
};

?>

<html>
<head>
<title>Erros - Mantis</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


</head>

<div class="w3-container">

<!--
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Consolidado de Erros</em></b></font></td>
  </tr>
</table>
-->
<br>
<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar por Programa,Rotina,ou Descrição.." id="myInput1" onkeyup="myFunction1()">
</div>

<div ng-app="myApp" >

<div class="w3-container" ng-controller="Erros">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny" id="myTable1">
  <tr bgcolor="#5555FF" class="w3-green" > 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="09%" align="center">Sistema <br><a href="VerErrosMantis.php?ord=10"><i class="fa fa-caret-up" <?php if ( $ordem == '10' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=10 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '10 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="10%" align="center">Programa <br><a href="VerErrosMantis.php?ord=1"><i class="fa fa-caret-up" <?php if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=1 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="10%" align="center">Rotina <br><a href="VerErrosMantis.php?ord=2"><i class="fa fa-caret-up" <?php if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=2 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">Linha <br><a href="VerErrosMantis.php?ord=3"><i class="fa fa-caret-up" <?php if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=3 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="08%" align="center">Número <br><a href="VerErrosMantis.php?ord=4"><i class="fa fa-caret-up" <?php if ( $ordem == '4' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=4 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '4 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="40%" align="center">Descrição <br><a href="VerErrosMantis.php?ord=5"><i class="fa fa-caret-up" <?php if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=5 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="03%" align="center">Qtde <br><a href="VerErrosMantis.php?ord=6"><i class="fa fa-caret-up" <?php if ( $ordem == '6' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=6 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '6 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="13%" align="center">Ult.Data <br><a href="VerErrosMantis.php?ord=9"><i class="fa fa-caret-up" <?php if ( $ordem == '9' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=9 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '9 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">MANTIS <br><a href="VerErrosMantis.php?ord=7"><i class="fa fa-caret-up" <?php if ( $ordem == '7' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerErrosMantis.php?ord=7 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '7 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
  </tr>
  
  <tr dir-paginate="x in names|itemsPerPage:11" > 
     	  
 
	  <td width="02%" align="center" >
	   <a href="VerErro.php?sis={{ x.sistema }}&pro={{ x.programa }}&rot={{ x.rotina }}&lin={{ x.linha }}&num={{ x.numero }}&des={{ x.descricao }}" >
	   {{ x.cnt }}
	   </a>
	   </td>
 
      <td width="09%" align="center" >{{ x.sistema }}</td>
	  
      <td width="10%" align="center" >{{ x.programa }}</td>
	  
      <td width="10%" align="center" >{{ x.rotina }}</td>
      
	  <td width="05%" align="center" >{{ x.linha }}</td>
	  
      <td width="08%" align="center" >{{ x.numero }}</td>
	  
      <td width="40%" align="center" >{{ x.descricao }}</td>
	  
      <td width="03%" align="center" >{{ x.qtde }}</td>
	  
      <td width="13%" align="center" >{{ x.ultdata }}</td>

      <td width="05%" align="center" title="{{x.labelBR}}"  bgcolor="{{x.color}}">
	  
  	  <a href="http://uniondata.com.br/cliente/mantisbt/view.php?id={{ x.mantis }}" target="_blank"> {{ x.mantis }} <span ng-if=" x.versao != '00.00.00' "><br>v.{{ x.versao }}</span></a> 
	  <span ng-if=" x.versao <> '00.00.00' "> <br> v.{{ x.versao }} </span>
	  
	  </td>

	  </tr>

</table>
<dir-pagination-controls max-size="5" boundary-links="true"></dir-pagination-controls>
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="js/dirPagination.js"></script>


<script>
var app = angular.module('myApp', ['angularUtils.directives.dirPagination']);
app.controller('Erros', function($scope, $http) {
	
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_errosmantis.php?ord=<?php echo $ordem ?>")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();
	
   
});
</script>

<script>
function myFunction1() {
  var input, filter, table, tr, td1, td2, td5, i;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable1");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td5 = tr[i].getElementsByTagName("td")[5];
    if ((td1) || (td2) || (td3)) {
      if ( (td1.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td5.innerHTML.toUpperCase().indexOf(filter) > -1) ){
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

