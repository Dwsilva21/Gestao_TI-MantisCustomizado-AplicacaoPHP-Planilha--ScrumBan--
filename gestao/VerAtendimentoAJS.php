
<html>
<head>
<title>Atendimento a Clientes</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="sortcut icon" href="images/favicon.ico" type="image/x-icon" />


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

<? 
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"filename.xlsx\"");
header("Cache-Control: max-age=0");
 ?>

</head>
<table border="0" width="100%" cellspacing="3" cellpadding="4" >
  <tr> 
    <td height="72" colspan="4" align="center"> 
      <div align="left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF"><div align="left"><img src="image/union_fullsize_distr.png" width="20%" height="20%"></div></td>
          </tr>
        </table>
        <font size="3" face="Verdana" color="#2499F6"><b><span class="topics"></span></b></font></div></td>
  </tr>
</table>

<div class="w3-container" ng-app="myApp" ng-controller="customersCtrl">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Atendimento a Clientes</em></b></font></td>
  </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-centered">
  <tr class="w3-light-blue">
    <td colspan="6" align="center">AGUARDANDO ATENDIMENTO</td>
  </tr>
</table>

<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar por Cliente,Motivo,Sistema,Descrição,Programa,Analista ou Contato.." id="myInput1" onkeyup="myFunction1()">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny" id="myTable1">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="02%" align="center">ID <br><a href="VerAtendimento.php?ord1=1 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=1 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="15%" align="center">Cliente <br><a href="VerAtendimento.php?ord1=2 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=2 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Motivo <br><a href="VerAtendimento.php?ord1=3 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=3 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Sistema <br><a href="VerAtendimento.php?ord1=4 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=4 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="45%" align="center">Descrição <br><a href="VerAtendimento.php?ord1=5 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=5 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Programa <br><a href="VerAtendimento.php?ord1=6 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=6 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Analista <br><a href="VerAtendimento.php?ord1=7 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=7 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Data <br><a href="VerAtendimento.php?ord1=8 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=8 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Contato <br><a href="VerAtendimento.php?ord1=9 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=9 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="06%" align="center">Telefone <br><a href="VerAtendimento.php?ord1=11 "><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=11 desc "><i class="fa fa-caret-down" title="descrescente"></i></a></td>
  </tr>


  <tr ng-repeat="x in names"> 
	  
 
	  <td width="02%" align="center" > 
      {{ x.cnt }} 
      </td>
 
      <td width="02%" align="center" > 
	  {{ x.id }}
      </td>

      <td width="15%" align="center" > 
      {{ x.razao }}
      </td>
      <td width="05%" align="center" > 
      {{ x.motivo }}
      </td>
      <td width="05%" align="center" > 
      {{ x.sistema }}
      </td>
      <td width="45%" align="center" > 
      {{ x.descricao }}
      </td>
      <td width="05%" align="center" > 
      {{ x.programa }}
      </td>
      <td width="05%" align="center" > 
      {{ x.analista }}
      </td>
      <td width="05%" align="center" > 
      {{ x.datahora_cadastro }}
      </td>
      <td width="05%" align="center" > 
      {{ x.nome_contato }}
      </td>
      <td width="06%" align="center" > 
      {{ x.fone_contato }}
      </td>

	  </tr>

 </table>

<br>


</div>

<br>
<br>

<script>
function myFunction1() {
  var input, filter, table, tr, td1, td2, td3, td4, td5, td6, td7, i;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable1");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[2];
    td2 = tr[i].getElementsByTagName("td")[3];
    td3 = tr[i].getElementsByTagName("td")[4];
    td4 = tr[i].getElementsByTagName("td")[5];
    td5 = tr[i].getElementsByTagName("td")[6];
    td6 = tr[i].getElementsByTagName("td")[7];
    td7 = tr[i].getElementsByTagName("td")[9];
	
    if ((td1) || (td2) || (td3) || (td4) || (td5) || (td6) || (td7)) {
   	  if ((td1.innerHTML.toUpperCase().indexOf(filter) > -1) || 
	      (td2.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td3.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td4.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td5.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td6.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td7.innerHTML.toUpperCase().indexOf(filter) > -1)   ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get("data/customers_mysql.php")
   .then(function (response) {$scope.names = response.data.records;});
});
</script>

</body>
</html>

