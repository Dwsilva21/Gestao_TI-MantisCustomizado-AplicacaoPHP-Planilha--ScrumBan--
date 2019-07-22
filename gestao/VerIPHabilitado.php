<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1";
};

?>

<html>
<head>
<title>IP's Habilitados</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>

<body>

<div ng-app="myApp" class="w3-container">
<!-- 
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>IP's Habilitados</em></b></font></td>
  </tr>
</table>
-->
<br>
<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar Cliente.." id="myInput" onkeyup="myFunction()">

<div ng-controller="Ips">
 <button id="Atual" ng-click="atualiza()">clique me</button>
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-small" id="myTable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="49%" align="center">Cliente <br><a href="VerIPHabilitado.php?ord=1"><i class="fa fa-caret-up fa-red" <?php if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerIPHabilitado.php?ord=1 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="49%" align="center">IP <br><a href="VerIPHabilitado.php?ord=2"><i class="fa fa-caret-up" <?php if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerIPHabilitado.php?ord=2 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
  </tr>

  <tr dir-paginate="x in names|itemsPerPage:11"> 
    <td width="02%" align="center"  bgcolor="#BDE2FF"> {{ x.cnt }} </td>
    <td width="30%" align="center" > {{ x.id }} </td>
    <td width="10%" align="center" > {{ x.ip }} </td>
  </tr>

 </table>
 <dir-pagination-controls max-size="5" boundary-links="true"></dir-pagination-controls>
 
 
</div>
</div>

<br>
<br>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="js/dirPagination.js"></script>

<script>
var app = angular.module('myApp', ['angularUtils.directives.dirPagination']);

app.controller('Ips', 
  function($scope, $http) 
  {
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_veriphabilitado.php?ord=<?php echo $ordem ?>")
        .then(function (response) {$scope.names = response.data.records;});
   alert("carregando..."); 
      }
   //$scope.atualiza();
    
  }
);

</script>


<script>
console.log( 10 + 8 );
function myFunction() {
  var input, filter, table, tr, td1, td2, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
	
    if ((td1) || (td2)) {

   	  if ((td1.innerHTML.toUpperCase().indexOf(filter) > -1) || 
	      (td2.innerHTML.toUpperCase().indexOf(filter) > -1) ) {
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

