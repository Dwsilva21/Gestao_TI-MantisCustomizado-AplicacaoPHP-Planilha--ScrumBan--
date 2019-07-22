<?
ini_set('default_charset','iso-8859-1');
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

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

</head>

<body>

<div ng-app="myApp" class="w3-container">

<a href="VerVersoes.php">
<div class="w3-padding w3-large w3-text-black">
    <i class="material-icons w3-xlarge" title="Voltar">home</i>
</div>
</a>


  
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Versão ] <? echo $mod ?> <? echo $ver ?></em></b></font></td>
  </tr>
</table>

<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar em ID ou SQL.." id="myInput" onkeyup="myFunction()"> 


<br>

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

<div ng-controller="Database">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny" id="myTable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="05%" align="center">ID </td>
    <td width="05%" align="center">Data </td>
    <td width="05%" align="center">MySQL </td>
    <td width="83%" align="center">SQL </td>
  </tr>

  <tr ng-repeat="x in names"> 
    <td width="02%" align="center"  bgcolor="#BDE2FF"> {{ x.cnt }} </td>
    <td width="05%" align="center" > {{ x.id }} </td>
    <td width="05%" align="center" > {{ x.data }} </td>
    <td width="05%" align="center" > {{ x.mysql }} </td>
    <td width="83%" align="center" > <span ng-bind-html="x.sql | trustAs"></span> </td>

	</tr>

 </table>
 
</div>

</div>

<script>
var app = angular.module('myApp', []);

app
.filter('trustAs', function($sce) {
        return function (input, type) {
            
                return $sce.trustAs(type || 'html', decodeURIComponent(input.replace(/\+/g, ' '))  );
            
        };
    })
	
.controller('Database', function($scope, $http) { 
   $http.get("data/dados_SEL_database.php?ord=<? echo $ordem ?>")  
   .then(function (response) { $scope.names = response.data.records ;}); 
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
    td2 = tr[i].getElementsByTagName("td")[4];
	
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

</head>

</html>