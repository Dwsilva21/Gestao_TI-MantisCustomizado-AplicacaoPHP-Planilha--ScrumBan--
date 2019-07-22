<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}

$op  = $_REQUEST["op"];
$id  = $_REQUEST["id"];
$ip  = $_REQUEST["ip"];
$aba = $_REQUEST["aba"];


$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1";
};

?>

<html>
<head>
<title>IP's Desconhecidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>


</head>

<body>
<div ng-app="myApp" class="w3-container">

<?php if ( $op == "Habilitar" ) {
      echo "<div ng-controller='HabIp'>";
      echo "   <div ng-repeat='y in names'>Habilitado {{ y.id }} - {{ y.ip }} </div>"; 
      echo "</div>";
   }
?>

<?php if ( $op == "Bloquear" ) {
      echo "<div ng-controller='BloqIp'>";
      echo "   <div ng-repeat='z in names'>Bloqueado {{ z.id }} - {{ z.ip }} </div>"; 
      echo "</div>";
	}  
?>


<!--
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>IP's Desconhecidos</em></b></font></td>
  </tr>
</table>
-->
<br>
<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar Cliente.." id="myInput" onkeyup="myFunction()">

<div ng-controller="Ips">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-small " id="myTable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="30%" align="center">Cliente <br><a href="VerIPDesconhecido.php?ord=1"><i class="fa fa-caret-up fa-red" <?php if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerIPDesconhecido.php?ord=1 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="30%" align="center">IP <br><a href="VerIPDesconhecido.php?ord=2"><i class="fa fa-caret-up" <?php if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerIPDesconhecido.php?ord=2 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="20%" align="center">Qtde<br>Tentativas</td>
    <td width="09%" align="center"></td>
    <td width="09%" align="center"></td>
  </tr>

  <tr ng-repeat="x in names"> 
    <td width="02%" align="center"  bgcolor="#BDE2FF"> {{ x.cnt }} </td>
    <td width="30%" align="center" > {{ x.id }} </td>
    <td width="30%" align="center" > {{ x.ip }} 
	<td width="20%" align="center" > {{ x.ocorrencias }} </td>
	<td width="09%" align="center" ><button class="w3-button w3-teal" ng-click="myAble(x.id,x.ip)" ng-model="hab">Habilitar</button></td>
	<td width="09%" align="center" ><button class="w3-button w3-red"  ng-click="myBlock(x.id,x.ip)" ng-model="bloq">Bloquear</button></td>
	</td>
  </tr>

 </table>
</div>
</div>
<br>
<br>

<script>
var app = angular.module('myApp', []);

app.controller('Ips', function($scope, $http) {

   $scope.myAble = function($pid,$pip) {
      var txt;
      var r = confirm('Confirma Habilitação do IP : ' + $pip + ' para o CLIENTE : ' + $pid);
      if (r == true) {
         window.open('data/dados_REP_veripdesconhecidoHab.php?ip=' + $pip + '&id=' + $pid.replace("&","^") + '&aba=<?php echo $aba ?>' ,  '<?php echo $aba ?>'  );
      }	  
      return $scope.firstName = 'Able : ' + $pid;
   };

   $scope.myBlock = function($pid,$pip) {
      var txt;
      var r = confirm('Confirma Bloqueio do IP : ' + $pip + ' para o CLIENTE : ' + $pid);
      if (r == true) {
         window.open('data/dados_REP_veripdesconhecidoBloq.php?ip=' + $pip + '&id=' + $pid.replace("&","^") + '&aba=<?php echo $aba ?>' , '<?php echo $aba ?>' );
      }	  
      return $scope.firstName = 'Blocked : ' + $pid;
   };

   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_veripdesconhecido.php?ord=<?php echo $ordem ?>")
        .then(function (response) {$scope.names = response.data.records;});
   };
   
   $scope.atualiza();

   
});


</script>

<script>
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

