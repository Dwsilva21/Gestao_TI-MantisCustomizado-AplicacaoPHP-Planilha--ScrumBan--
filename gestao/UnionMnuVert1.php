<!DOCTYPE html>
<?
session_start();
$usr = $_POST["usrname"];
$pwd = $_POST["psw"];
$op  = $_REQUEST["op"];

$lnk = array( "", "nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm" );

if ( $_SESSION['pin'] <> 1980 ) { $_SESSION['pin'] = 0; }

if ( ($usr=="Union"  &&  $pwd=="@1234") || ( $_SESSION['pin'] == 1980 ) ) {
   
    $lnk = array( "", "VerCli.php","VerErrosMantis.php","VerIPHabilitado.php","VerIPDesconhecido.php","VerIPBloqueado.php","VerLog.php","VerAtendimento.php", "VerVersoes.php" );
   
    $_SESSION['pin'] = 1980;   
	$usr="Union";
}

?>

<html>
<head>
<title>Uniondata - Suporte</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<META HTTP-EQUIV="REFRESH" CONTENT="1200;URL=http://www.uniondata.com.br/gestao/UnionMnuVert.php"> 


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="sortcut icon" href="image/favicon.ico" type="image/x-icon" />

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>


<body>

<div>
<? #echo $_SESSION['pin'] ; ?>
<table border="0" width="100%" cellspacing="3" cellpadding="4" >
  <tr> 
    <td height="72" colspan="4" align="center"> 
      <div align="left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF"><div align="left"><img src="image/union_fullsize_distr.png" width="10%" height="10%"></div></td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
</div>

<div ng-app="myApp" >
<div ng-controller="Ips">

<div class="w3-sidebar w3-bar-block w3-black w3-card-2" style="width:210px;">
  <span class='w3-bar-item w3-white w3-center'>
    <div class="w3-tag w3-round w3-green" style="padding:3px">
    <div class="w3-tag w3-round w3-green w3-border w3-border-white"><font color=black>UD</font>ashboard</div>
  </div>
  </span>

  <? if ( $_SESSION['pin'] == 1980 ) { echo "<span class='w3-bar-item w3-light-gray w3-left'>Usu&aacute;rio : ". $usr . "</span>"; } ?>
  <button class="w3-button w3-block w3-left-align" onclick="myAccFunc()">Clientes <i class="fa fa-caret-down"></i></button>

  
  <div ng-repeat="x in names" id="Aplicacao" class="w3-hide w3-white w3-card-2">
      <a href="<? echo $lnk[1]; ?>" target="iframe_a" class="w3-bar-item w3-button">Atualiza&ccedil;&otilde;es/Erros</a>
      <a href="<? echo $lnk[2]; ?>" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>Consolidado Erros</a>
      <a href="<? echo $lnk[3]; ?>" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Habilitados</a>
      <span ng-if=" x.cnt >= 1 ">
         <a href="<? echo $lnk[4]; ?>" target="iframe_a" class="w3-bar-item w3-button w3-red">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Desconhecidos [{{ x.cnt }}]</a>
	  </span>
      <span ng-if=" x.cnt == 0 ">
         <a href="<? echo $lnk[4]; ?>" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Desconhecidos</a>
	  </span>	 
      <a href="<? echo $lnk[5]; ?>" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Bloqueados</a>
      <a href="<? echo $lnk[6]; ?>" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>Log GravaErroNuvemMantis</a>
  </div>

  <a href="<? echo $lnk[7]; ?>" target="iframe_a" class="w3-bar-item w3-button w3-white ">Atendimento</a>
  <a href="<? echo $lnk[8]; ?>" target="iframe_a" class="w3-bar-item w3-button w3-white ">Versões Sistemas</a>

  <span class='w3-bar-item w3-black'>     </span>
  <span class='w3-bar-item w3-black'>     </span>
  <span class='w3-bar-item w3-black'>     </span>
  
  <button class="w3-button w3-left <? if ( $_SESSION['pin'] <> 1980 ) { echo "w3-red";}  ?>" style="width:210px;" onclick="document.getElementById('id01').style.display='block'">Login <i class="glyphicon glyphicon-user"></i></button>
  
</div>

 
    <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">X</span>
        <img src="image/img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form class="w3-container" action="UnionMnuVert.php" method="post">
        <div class="w3-section">
          <label><b>Usu&aacute;rio</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Entre Usu&aacute;rio" name="usrname" required>
          <label><b>Senha</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Entre Senha" name="psw" required>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Me Lembre
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Esqueceu a <a href="#">senha?</a></span>
      </div>

    </div>

  </div>

</div>

</div>

</body>
</html>

<script>
var app = angular.module('myApp', []);
app.controller('Ips', function($scope, $http) {
   $http.get("data/dados_SEL_vertotipdesconhecido.php")
   .then(function (response) {$scope.names = response.data.records;});
});

</script>



<script>

function myAccFunc() {
    var x = document.getElementById("Aplicacao");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-green";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-green", "");
    }
}
myAccFunc();
</script>

<div class="w3-container" style="margin-left:200px"><iframe class="w3-white" width="100%" height="850" name="iframe_a" frameborder="0" src="<? if ( $op != "" ) {  echo $lnk[$op]; }?>"></div>		
		
</body>
</html>
