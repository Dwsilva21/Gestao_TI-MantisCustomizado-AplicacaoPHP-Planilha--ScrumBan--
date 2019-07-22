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

<html ng-app="app">
<head>
<title>Versão</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.27/angular.min.js"></script>

<body ng-controller="Controller">

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
        <p ng-bind="xml"></p>
		
</body>


<script type="text/javascript">
<!--
(function() {
    var app = angular.module('app', []);
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
//-->
</script>
</head>



</html>