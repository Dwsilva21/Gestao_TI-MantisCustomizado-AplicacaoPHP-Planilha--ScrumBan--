<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "11 desc";
};

?>

<html>
<head>
<title>Versões Sistemas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

</head>

<body>
<div ng-app="myApp" class="w3-container">
<!--
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Versões Sistemas [<?php echo $_SESSION['usr'] ?>]</em></b></font></td>
  </tr>
</table>
-->

<?php #<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar Cliente.." id="myInput" onkeyup="myFunction()"> ?>
<br>
<div ng-controller="Versoes">

<form action="data/dados_UPD_versaodesenvolvimento.php" method="post">
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-small" id="myTable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="02%" align="center">ID <br><a href="VerVersoes.php?ord=1"><i class="fa fa-caret-up fa-red" <?php if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersoes.php?ord=1 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="05%" align="center">Módulo <br><a href="VerVersoes.php?ord=2"><i class="fa fa-caret-up" <?php if ( $ordem == '2' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersoes.php?ord=2 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '2 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="10%" align="center">Versão <br><a href="VerVersoes.php?ord=3"><i class="fa fa-caret-up" <?php if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersoes.php?ord=3 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="20%" align="center">Nome <br><a href="VerVersoes.php?ord=4"><i class="fa fa-caret-up" <?php if ( $ordem == '4' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersoes.php?ord=4 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '4 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="13%" align="center">Data <br><a href="VerVersoes.php?ord=5"><i class="fa fa-caret-up" <?php if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersoes.php?ord=5 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="10%" align="center">Arquivo <br><a href="VerVersoes.php?ord=6"><i class="fa fa-caret-up" <?php if ( $ordem == '6' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersoes.php?ord=6 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '6 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="08%" align="center"></td>
    <td width="28" align="center">Desenvolvimento <br><a href="VerVersoes.php?ord=8"><i class="fa fa-caret-up" <?php if ( $ordem == '8' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerVersoes.php?ord=8 desc"><i class="fa fa-caret-down" <?php if ( $ordem == '8 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
    <td width="02%" align="center"></td>
  </tr>

  <tr ng-repeat="x in names"> 
  <td width="02%" align="center"  bgcolor="#BDE2FF"> {{ x.cnt }} </td>
    <td width="02%" align="center" > {{ x.id }} </td>
    <td width="05%" align="center" > {{ x.modulo }} </td>
    
	<td width="10%" align="center" >  

       <span ng-if=" x.desenvolvimento.indexOf('.') > 0 "> {{ x.versao }} 
	      <a title="conteudo da versão" href="VerVersao.php?sis={{ x.project_id }}&mod={{ x.modulo }}&ver={{ x.versao }}"><span class="w3-badge w3-green w3-tiny">+</span></a>
	   </span>
	
       <span ng-if=" x.arquivo.indexOf('xml') > 0 "> {{ x.versao }} 
	      <a href="VerDatabase.php?sis={{ x.project_id }}&mod={{ x.modulo }}&ver={{ x.versao }}"><span class="w3-badge w3-green w3-tiny">+</span></a>
	   </span>
	
    <span ng-if=" x.versao.indexOf('.') <= 0 && x.arquivo.indexOf('xml') <= 0"> {{ x.versao }}  </span>
   
	</td>
	
    <td width="20%" align="center" > {{ x.nome }} </td>
    <td width="13%" align="center" > {{ x.datahora }} </td>
    <td width="10%" align="center" > {{ x.arquivo }} </td>
    <td width="08%" align="center" > <span ng-if=" x.versao.indexOf('.') > 0 "><a href="{{ x.pasta }}{{ x.arquivo }}"><span class="w3-badge w3-red">download</span></a></span>	</td>

	
    <td width="28%" align="center" > 
	<div class="w3-half w3-row-padding">
	<span ng-if=" x.versao.indexOf('.') > 0 ">
	<input <?php if ( substr($_SESSION['acs'],0,1) == '0' and substr($_SESSION['acs'],2,1) == '0' ) { echo  "ng-disabled='!edit'"; } ?> class="w3-input w3-border" type="text" name="id{{ x.id }}"  placeholder="Versão" value="{{ x.desenvolvimento }}" >
	</span>
	</div>

	<span ng-if=" x.desenvolvimento != x.versao && x.desenvolvimento.indexOf('.') > 0 && x.desenvolvimento >= x.versao ">
	<div class="w3-half w3-row-padding w3-Yellow ">
           <span ng-if=" x.versao.indexOf('.') > 0 "><button class='w3-btn w3-green w3-border' <?php if ( substr($_SESSION['acs'],0,1) == '0' and substr($_SESSION['acs'],2,1) == '0' ) { echo  "ng-disabled='!edit'"; } ?> >Gravar</button></span> 
     	   <span ng-if=" x.desenvolvimento.indexOf('.') > 0 ">	<span class="w3-tiny">há {{ x.dias }} dia(s)</span> </span>
	</div>
	</span>

	<span ng-if=" x.desenvolvimento != x.versao && x.desenvolvimento.indexOf('.') > 0 && x.desenvolvimento < x.versao ">
	<div class="w3-half w3-row-padding w3-red" title="Versão inferior a disponivel para download">
           <span ng-if=" x.versao.indexOf('.') > 0 "><button class='w3-btn w3-green w3-border' <?php if ( substr($_SESSION['acs'],0,1) == '0' and substr($_SESSION['acs'],2,1) == '0' ) { echo  "ng-disabled='!edit'"; } ?> >Gravar</button></span> 
     	   <span ng-if=" x.desenvolvimento.indexOf('.') > 0 ">	<span class="w3-tiny">há {{ x.dias }} dia(s)</span> </span>
	</div>
	</span>
	
	
	
	<span ng-if=" x.versao == x.desenvolvimento ">
	<div class="w3-half w3-row-padding">
           <span ng-if=" x.versao.indexOf('.') > 0 "><button class='w3-btn w3-green w3-border' <?php if ( substr($_SESSION['acs'],0,1) == '0' and substr($_SESSION['acs'],2,1) == '0' ) { echo  "ng-disabled='!edit'"; } ?> >Gravar</button></span> 
     	   <span ng-if=" x.desenvolvimento.indexOf('.') > 0 ">	<span class="w3-tiny">há {{ x.dias }} dia(s)</span> </span>
	</div>
	</span>

	</td>

    <td width="02%" align="center" valign="center" > 
	<span ng-if=" x.desenvolvimento.indexOf('.') > 0 ">	<a title="conteudo da versão" href="VerVersao.php?sis={{ x.project_id }}&mod={{ x.modulo }}&ver={{ x.desenvolvimento }}"><span class="w3-badge w3-green w3-tiny">+</span></a>
	</span>
	 
	</td>


	
  </tr>

 </table>
</form>
 
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
	
	
.controller('Versoes', function($scope, $http) {
   
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_verversoes.php?ord=<?php echo $ordem ?>")
        .then(function (response) {$scope.names = response.data.records;});
      }
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

