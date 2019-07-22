<?php
session_start();
include("library/ambiente.php");

/* define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
/* define o prazo do cache em 30 minutos */
session_cache_expire(600);
$cache_expire = session_cache_expire();
?>

<html>
<title>AllDash</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap-dynamic-tabs.js"></script>

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif;}

div. {  line-height: 20%; }
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Minha Empresa</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse  w3-pale-green w3-animate-left" style="z-index:3;width:250px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="image/img_avatar4.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Bem vindo, <strong>Daniel</strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
 
  
  <div class="w3-container">
    <h5 class="w3-light-green w3-padding ">Menu</h5>
  </div>

  <div class="w3-bar-block w3-small" style="line-height: 20%;">
    <a href="#" name="VerAtendimento.php"    id="btnHtml1" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
<!--     <a href="#" name="VerVersoes.php"        id="btnHtml3" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Versões</a>
    <a href="#" name="grafico_barras.php"    id="btnHtml4" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Gráfico</a>
    <a href="#" name="VerLog.php"            id="btnHtml5" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Log</a>
    <a href="#" name="VerCli.php"            id="btnHtml6" name="VerAtendimento.php" id="btnHtml1" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Atualizações/Erros</a>
    <a href="#" name="VerErrosMantis.php"    id="btnHtml7" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  Consolidado Erros</a>
    <a href="#" name="VerIPHabilitado.php"   id="btnHtml8" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  IPs Habilitados</a>
    <a href="#" name="VerIPDesconhecido.php" id="btnHtml9" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  IPs Desconhecidos</a>
    <a href="#" name="VerIPBloqueado.php"    id="btnHtml0" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  IPs Bloqueados</a>
-->	
    <a onclick="myAbreMenu('Cad')" href="javascript:void(0)" class="w3-bar-item w3-button " id="myBtnCad"><i class="fa fa fa-folder-open fa-fw"></i> 
      Cadastros <i class="fa fa-caret-down"></i>
    </a>
    <div id="Cad" class="w3-bar-block w3-hide w3-padding  w3-small" style="line-height: 40%;">
      <a href="#" name="VerIPBloqueado.php"    id="btnCad01" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Contas Bancárias</a>
      <a href="#" name="VerIPHabilitado.php"    id="btnCad02" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Plano de Contas</a>
      <a href="#" name="VerIPBloqueado.php"    id="btnCad03" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Clientes</a>
      <a href="#" name="VerIPBloqueado.php"    id="btnCad04" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Condomínios</a>
      <a href="#" name="VerIPBloqueado.php"    id="btnCad05" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Blocos</a>
      <a href="#" name="VerIPBloqueado.php"    id="btnCad06" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Unidades</a>
      <a href="#" name="VerIPBloqueado.php"    id="btnCad07" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Feriados</a>
    </div> 

    <a onclick="myAbreMenu('Prv')" href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" id="myBtnPrv"><i class="fa fa fa-folder-open fa-fw"></i> 
      Previsão Orçamentária <i class="fa fa-caret-down"></i>
    </a>
    <div id="Prv" class="w3-bar-block w3-hide w3-padding  w3-small">
      <a href="#" name="VerIPBloqueado.php"    id="btnPrv01" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Grupo de Contas</a>
      <a href="#" name="VerIPBloqueado.php"    id="btnPrv02" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Previsão</a>
    </div> 


    <a onclick="myAbreMenu('Rat')" href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" id="myBtnRat"><i class="fa fa fa-folder-open fa-fw"></i> 
      Rateio <i class="fa fa-caret-down"></i>
    </a>
    <div id="Rat" class="w3-bar-block w3-hide w3-padding  w3-small" style="line-height: 40%;">
    </div> 
	
    <a onclick="myAbreMenu('Rec')" href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" id="myBtnRec"><i class="fa fa fa-folder-open fa-fw"></i> 
      Recibos <i class="fa fa-caret-down"></i>
    </a>
    <div id="Rec" class="w3-bar-block w3-hide w3-padding  w3-small" style="line-height: 40%;">
    </div> 

    <a onclick="myAbreMenu('Bai')" href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" id="myBtnBai"><i class="fa fa fa-folder-open fa-fw"></i> 
      Baixa <i class="fa fa-caret-down"></i>
    </a>
    <div id="Bai" class="w3-bar-block w3-hide w3-padding  w3-small" style="line-height: 40%;">
    </div> 

    <a onclick="myAbreMenu('Ctb')" href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" id="myBtnCtb"><i class="fa fa fa-folder-open fa-fw"></i> 
      Contábil <i class="fa fa-caret-down"></i>
    </a>
    <div id="Ctb" class="w3-bar-block w3-hide w3-padding  w3-small" style="line-height: 40%;">
    </div> 

    <a onclick="myAbreMenu('Cob')" href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" id="myBtnCob"><i class="fa fa fa-folder-open fa-fw"></i> 
      Cobrança <i class="fa fa-caret-down"></i>
    </a>
    <div id="Cob" class="w3-bar-block w3-hide w3-padding  w3-small" style="line-height: 40%;">
    </div> 



    <hr>
	<hr>
    <a href="#" name="VerAtendimento.php"    id="btnHtml2" class="w3-bar-item w3-button w3-padding w3-green"><i class="fa fa-users fa-fw"></i>  Atendimento</a>
 
	</div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main  " style="margin-left:250px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container w3-light-grey" style="padding-top:02px">
    <h5><b><i class="fa fa-dashboard"></i> Meu Dashboard</b></h5>
  </header>

  <!-- Tab panes -->
  <nav class="nav nav-tabs w3-light-blue" id="tabs"></nav> 
  <!-- <div class="navbar navbar-inverse w3-light-blue" id="tabs"></div>-->
  <!-- Tab panes -->
  
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4></h4>
    <p>Powered by <a href="http://www.allwaresolucoes.com.br" target="_blank">Allware Soluções</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

<script type="text/javascript">
var d ;
var n ;
var tabs = $('#tabs').bootstrapDynamicTabs().addTab({
	title:'Home ',
	text:'<br>Plugin jQuery para manipular tabs do bootstrap de forma dinâmica, excelente para aplicações multitelas na WEB ou em runtimes como node-webkit ou electron.',
	html: '<img src="image/adm.jpg" alt="boat" style="width:100%;min-height:350px;max-height:580px;">', 
	closable: false
});
 
$('#btnCad01').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad02').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad03').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad04').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad05').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad06').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad07').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad08').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad09').click(function(){ carrega_tab( this.innerHTML, this.name, true); });
$('#btnCad10').click(function(){ carrega_tab( this.innerHTML, this.name, true); });

function carrega_tab( pInner, pName, pClose )
{
	d = new Date();
    n = d.getTime();
	tabs.addTab({
		title: '[ ' + pInner + ' ] ' ,
		html: '<iframe class="w3-white" frameborder="0"  width="100%" height="650" id="iframe' + n + '" name="iframe' + n + '" src="' + pName + '?aba=iframe' + n + '"></iframe>',
		id: 'aba' + n,
		closable: pClose
	});
}		


$('#btnAjax').click(function(){
	tabs.addTab({
		title: 'Carregando via Ajax. ',
		html: '<h2>Desenvolvido por AJAX',
		ajaxUrl: 'VerCli.php', 
		id: 'ajax'   
	});
});
$('#btnIon').click(function(){
	tabs.addTab({
		title: 'Aba com ícone. ',
		html: '<h2>Aba com ícone</h2>Um icone Font Awesome, exemplo: fa fa-user. O icone será mostrado na aba. Você também pode usar os glyphicon do Bootstrap </code>',
		icon: 'fa fa-user'
	})
})


function myAbreMenu(pMenu) {
  var x = document.getElementById(pMenu);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
