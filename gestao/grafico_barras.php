<?php
ini_set('default_charset','iso-8859-1');
session_start(); 
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}
 
$date = new DateTime();
?>


<html>
<head>
<title>Grafico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="estilo.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

</head>


<body>

<div>

<br>
  <!--
  <table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
     <tr class="w3-light-grey">
       <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Gráfico diário de Erros</em></b></font></td>
     </tr>
   </table>
   -->

   <div class="w3-container w3-small w3-text-green"> 
      <div></div>  
	      <iframe src="graf_linha.php?saida=tela" height="550" width="100%" style="border:none;"></iframe>
      </div>
   </div>
</div>

<br>
   


<div ng-app="myApp" class="w3-small">

   <table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
     <tr class="w3-light-grey">
       <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Gráfico diário de Erros [<?php echo  $date->format('Y-m-d H:i:s'); ?>]</em></b></font></td>
     </tr>
   </table>

   <div class="w3-container w3-small w3-text-green" ng-controller="Sistema">
      <div>Porcentagem por SISTEMA</div>

      <div class="w3-container w3-small w3-black w3-row" >
         <div  class="w3-tiny w3-col" style="width:130px"> SISTEMA </div>
         <div  class="w3-tiny w3-col" style="width:40px"> Qtd </div>
         <div  class="w3-tiny w3-col" style="width:500px">  </div>
      </div>
	  
      <div class="w3-container w3-small w3-text-black w3-row" ng-repeat="y in names">
         <div  class="w3-tiny w3-col" style="width:130px"> {{ y.sistema }} </div>
         <div  class="w3-tiny w3-col" style="width:40px"> {{ y.qtde }} </div>
         <div  class="w3-tiny w3-col" style="width:500px"> <div class="barra{{ y.cnt }}"  style="width:{{ y.perc*5 }}" >  {{ y.perc }} %</div></div>
      </div>
   </div>
  
   <br>

   <div class="w3-container w3-small w3-text-green" ng-controller="Cliente">
      <div>Porcentagem por CLIENTE</div>

      <div class="w3-container w3-small w3-black w3-row" >
         <div  class="w3-tiny w3-col" style="width:330px"> CLIENTE </div>
         <div  class="w3-tiny w3-col" style="width:40px"> Qtd </div>
         <div  class="w3-tiny w3-col" style="width:40px"> % </div>
         <div  class="w3-tiny w3-col" style="width:300px"> </div>
      </div>

      <div class="w3-container w3-small w3-text-black w3-row" ng-repeat="y in names">
         <div  class="w3-tiny w3-col" style="width:330px"> {{ y.cliente }} </div>
         <div  class="w3-tiny w3-col" style="width:40px"> {{ y.qtde }} </div>
         <div  class="w3-tiny w3-col" style="width:40px"> {{ y.perc }} </div>
         <div  class="w3-tiny w3-col" style="width:300px"> <div class="barra{{ y.cnt }}"  style="width:{{ y.perc*3 }}" >  {{ y.perc }} %</div></div>
      </div>
   </div>
  
   <br><br><br>
  
   <table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
     <tr class="w3-light-grey">
       <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Gráfico Acumulado de Erros</em></b></font></td>
     </tr>
   </table>

   <div class="w3-container w3-small w3-text-green" ng-controller="SistemaAll">
      <div>Porcentagem por SISTEMA</div>

      <div class="w3-container w3-small w3-black w3-row" >
         <div  class="w3-tiny w3-col" style="width:130px"> SISTEMA </div>
         <div  class="w3-tiny w3-col" style="width:40px"> Qtd </div>
         <div  class="w3-tiny w3-col" style="width:500px">  </div>
      </div>
	  
      <div class="w3-container w3-small w3-text-black w3-row" ng-repeat="y in names">
         <div  class="w3-tiny w3-col" style="width:130px"> {{ y.sistema }} </div>
         <div  class="w3-tiny w3-col" style="width:40px"> {{ y.qtde }} </div>
         <div  class="w3-tiny w3-col" style="width:500px"> <div class="barra{{ y.cnt }}"  style="width:{{ y.perc*5 }}" >  {{ y.perc }} %</div></div>
      </div>
   </div>
  
   <br>

   <div class="w3-container w3-small w3-text-green" ng-controller="ClienteAll">
      <div>Porcentagem por CLIENTE</div>

      <div class="w3-container w3-small w3-black w3-row" >
         <div  class="w3-tiny w3-col" style="width:330px"> CLIENTE </div>
         <div  class="w3-tiny w3-col" style="width:40px"> Qtd </div>
         <div  class="w3-tiny w3-col" style="width:40px"> > 3% </div>
         <div  class="w3-tiny w3-col" style="width:300px"> </div>
      </div>

      <div class="w3-container w3-small w3-text-black w3-row" ng-repeat="y in names">
         <div  class="w3-tiny w3-col" style="width:330px"> {{ y.cliente }} </div>
         <div  class="w3-tiny w3-col" style="width:40px"> {{ y.qtde }} </div>
         <div  class="w3-tiny w3-col" style="width:40px"> {{ y.perc }} </div>
         <div  class="w3-tiny w3-col" style="width:300px"> <div class="barra{{ y.cnt }}"  style="width:{{ y.perc*3 }}" >  {{ y.perc }} %</div></div>
      </div>
   </div>
   
 </div>

 
 

<script>
var app = angular.module('myApp', []);
app.controller('Sistema', function($scope, $http) {
   
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_graficoerrossistema.php?all=0")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();
   
});
app.controller('Cliente', function($scope, $http) {
   
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_graficoerroscliente.php?all=0")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();
   
});
app.controller('SistemaAll', function($scope, $http) {
   
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_graficoerrossistema.php?all=1")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();
   
});
app.controller('ClienteAll', function($scope, $http) {
   
   $scope.atualiza = function () 
      {	
        $http.get("data/dados_SEL_graficoerroscliente.php?all=1")
        .then(function (response) {$scope.names = response.data.records;});
      }
   $scope.atualiza();
   
});

</script>




</body>
</html>