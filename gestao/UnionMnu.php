<!DOCTYPE html>
<?
session_start();
$usr = $_POST["usrname"];
$pwd = $_POST["psw"];

$lnk1 = "#";
$lnk2 = "#";
$lnk3 = "#";
$lnk4 = "#";
$_SESSION['pin'] = 0;
if ( $usr=="Union"  &&  $pwd=="@1234" ) {
   $lnk1 = "VerCli.php";
   $lnk2 = "VerAtendimento.php";
   $_SESSION['pin'] = 1980;   
}
?>

<html>
<head>
<title>Uniondata - Suporte</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="sortcut icon" href="image/favicon.ico" type="image/x-icon" />

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>


<body>

<div>
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


<div class="w3-container">

   <div class="w3-bar w3-border w3-black">
 	  <? if ( $_SESSION['pin'] == 1980 ) { echo "<span class='w3-bar-item w3-light-gray'>Usu&aacute;rio : ". $usr . "</span>"; } ?>
      <div class="w3-dropdown-click">
        <button class="w3-button" onclick="myFunction()">Clientes <i class="fa fa-caret-down"></i></button>
        <div id="aplicacao" class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="<? echo $lnk1; ?>" class="w3-bar-item w3-button">Atualizacoes/Erros</a>
          <a href="<? echo $lnk2; ?>" class="w3-bar-item w3-button">Atendimento</a>
        </div>
      </div>
      <button class="w3-button w3-right" onclick="document.getElementById('id01').style.display='block'">Login <i class="glyphicon glyphicon-user"></i></button>
   </div>

 
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">X</span>
        <img src="image/img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form class="w3-container" action="UnionMnu.php" method="post">
        <div class="w3-section">
          <label><b>Usu&aacute;rio</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Entre Usuario" name="usrname" required>
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


  
</body>

<script>
function myFunction() {
    var x = document.getElementById("aplicacao");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

</script>

		
</body>
</html>
