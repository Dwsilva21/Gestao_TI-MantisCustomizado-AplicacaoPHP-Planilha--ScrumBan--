<?php
session_start();
include("library/conecta3307.php");
include("library/funcoes.php");
ini_set('default_charset','iso-8859-1');

/* define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
/* define o prazo do cache em 30 minutos */
session_cache_expire(600);
$cache_expire = session_cache_expire();

/* inicia a sessão */

if ( $_SESSION['hora'] == "" ) { $_SESSION['hora'] = date("Y-m-d H:i:s"); }


$usr = $_POST["usrname"];
$pwd = $_POST["psw"];
$op  = $_REQUEST["op"];


if ( $usr != "" ) { 
     $con = Conecta("sac");
     $acs = Verifica_Usuario($usr, $pwd, $con); 
     if ( $acs == "999" ) {
        $_SESSION['pin'] = 0;		
   	    $_SESSION['usr'] = ""; 
	    $_SESSION['acs'] = ""; 
     };
     if ( $acs != "999" ) {
        $_SESSION['pin'] = 1980;   
   	    $_SESSION['usr'] = $usr; 
	    $_SESSION['acs'] = $acs; 
	 }
}

if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" )
   { $lnk = array( "", "nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm","nada.htm" ); }	
else 
{	

   $lnk = array( "", "VerCli.php","VerErrosMantis.php","VerIPHabilitado.php","VerIPDesconhecido.php","VerIPBloqueado.php","VerLog.php","VerAtendimento.php", "VerVersoes.php", "grafico_barras.php", "semacesso.htm"); 

   if ( substr( $_SESSION['acs'] , -1 ) == "1" )
   { $lnk = array( "", "VerCli.php","VerErrosMantis.php","VerIPHabilitado.php","VerIPDesconhecido.php","VerIPBloqueado.php","VerLog.php","VerAtendimento.php", "VerVersoes.php", "grafico_barras.php", "VerSLA.php"); }

   if ( substr( $_SESSION['acs'] , 1,1 ) == "1" )
   { $lnk = array( "", "VerCli.php","VerErrosMantis.php","VerIPHabilitado.php","VerIPDesconhecido.php","VerIPBloqueado.php","VerLog.php","VerAtendimento.php", "VerVersoes.php", "grafico_barras.php", "semacesso.htm"); }


}
?>
<!DOCTYPE html>
<html>
<head>
<title>Uniondata - Suporte</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php //<META HTTP-EQUIV="REFRESH" CONTENT="1200;URL=http://www.uniondata.com.br/gestao/UnionMnuVert.php">  ?>


<link rel="stylesheet"   href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet"   href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet"   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="sortcut icon" href="image/favicon.ico" type="image/x-icon" />

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>


<body bgcolor="blue">

<div ><div align="left">
   <table width="250">
   <tr align="center"><td><img src="image/empresa.jpg" width="90%" height="90%"></td></tr>
   </table>
</div>

<div ng-app="myApp" >
<div ng-controller="Ips">

<div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-left w3-border-bottom w3-black"   id="mySidebar" style="height:650px;width:250px;">
  <span class='w3-bar-item w3-light-grey w3-center'>
    <div class="w3-tag w3-round w3-green" style="padding:3px">
    <div class="w3-tag w3-round w3-green w3-border w3-border-white"><font color=black>UD</font>ash</div>
  </div>
  </span>


  <button class="w3-button w3-left w3-gray" style="width:250px;" onclick="closeLeftMenu()">Fechar &times;</button>

  <?php if ( $_SESSION['pin'] == 1980 ) { echo "<span class='w3-bar-item w3-light-gray w3-left'>Usu&aacute;rio : ". $_SESSION['usr'] . "</span>"; } ?>
  <button class="w3-button w3-block w3-left-align" onclick="myAccFunc()">Clientes <i class="fa fa-caret-down"></i></button>

  
  <div ng-repeat="x in names" id="Aplicacao" class="w3-hide w3-white w3-card-2">
      <a href="<?php echo $lnk[1]; ?>" onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>Atualiza&ccedil;&otilde;es/Erros</a>
      <a href="<?php echo $lnk[2]; ?>" onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>Consolidado Erros</a>
      <a href="<?php echo $lnk[3]; ?>" onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Habilitados</a>
      <span ng-if=" x.cnt >= 1 ">
         <a href="<?php echo $lnk[4]; ?>" onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button w3-red">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Desconhecidos [{{ x.cnt }}]</a>
	  </span>
      <span ng-if=" x.cnt == 0 ">
         <a href="<?php echo $lnk[4]; ?>" onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Desconhecidos</a>
	  </span>	 
      <a href="<?php echo $lnk[5]; ?>" onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button">&nbsp;&nbsp;  <i class="fa fa-angle-right">&nbsp; </i>IP's Bloqueados</a>
  </div>

  <a href="<?php echo $lnk[6]; ?>"  onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button w3-white ">Log GravaErroNuvemMantis</a>
  <a href="<?php echo $lnk[7]; ?>"  onclick="closeLeftMenu();myStopFunction();" target="iframe_a" class="w3-bar-item w3-button w3-white ">Atendimento</a>
  <a href="<?php echo $lnk[8]; ?>"  onclick="closeLeftMenu();myStopFunction();" target="iframe_a" class="w3-bar-item w3-button w3-white ">Versões Sistemas</a>
  <a href="<?php echo $lnk[9]; ?>"  onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button w3-sand  ">Gráficos Erros</a>
  <a href="<?php echo $lnk[10]; ?>" onclick="closeLeftMenu();Redirect();" target="iframe_a" class="w3-bar-item w3-button w3-white ">SLA</a> 

  <span class='w3-bar-item w3-black'>     </span>
  <span class='w3-bar-item w3-black'>     </span>
  <span class='w3-bar-item w3-black'>     </span>
  
  <button class="w3-button w3-left <?php if ( $_SESSION['pin'] <> 1980 ) { echo "w3-red";}  ?>" style="width:250px;" onclick="document.getElementById('id01').style.display='block'">Login <i class="glyphicon glyphicon-user"></i></button>

  <span class='w3-bar-item w3-black w3-tiny' align="center"><table><tr><td> &nbsp; </td></tr>
                                                                   <tr><td> [<?php echo( $_SESSION['hora'] ); ?>]</td></tr> 
                                                                   <tr><td> Sessão expira em : <?php echo $cache_expire ?> minutos </td></tr></table>
																   </span>
</div>

 
    <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:200px">
  
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
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
function openLeftMenu() {
    document.getElementById("mySidebar").style.display = "block";
}
function closeLeftMenu() {
    document.getElementById("mySidebar").style.display = "none";
}

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

var myVar;
function Redirect()
{  myVar = setTimeout("location.reload(true);",300000); }

function myStopFunction() 
{ clearTimeout(myVar); }

Redirect();
 


</script>

<?php
if ( $op <> "" ) {
   echo "<script>closeLeftMenu();</script>";
}		
?>

<div zclass="w3-main" id="main">
  <button class="w3-button w3-xlarge" onclick="openLeftMenu()">
  <table><tr><td>&#9776;</td></tr>
  <tr><td class="w3-small">Menu</td></tr>
  </table>
  </button>
  <div class="w3-container" style="margin-left:0px"><iframe class="w3-white" width="100%" height="900" name="iframe_a" frameborder="0" src="<?php if ( $op != "" ) {  echo $lnk[$op]; }?>"></div>		

</div>

</div>

</body>
</html>
