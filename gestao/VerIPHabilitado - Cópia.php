<?
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { ?> <script> parent.window.location.href ="UnionMnuVert.php" </script> <? }

include("data/conecta3307.php");

$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1";
};
$query = "SELECT a.id, a.ip ";
$query .= " FROM cliente_ip_habilitado a ORDER BY 1,2 ";
$result = mysql_query($query) or die("A consulta falhou : " . mysql_error());
?>

<html>
<head>
<title>IP's Habilitados</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="sortcut icon" href="images/favicon.ico" type="image/x-icon" />
<style>
html, body, h1, h2, h3, h4, h5, h6 {
  font-family: "Verdana", cursive, sans-serif;
}
</style>


</head>

<div class="w3-container">
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>IP's Habilitados</em></b></font></td>
  </tr>
</table>

<input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar Cliente.." id="myInput" onkeyup="myFunction()">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable " id="myTable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="49%" align="center">Cliente <br><a href="VerIPHabilitado.php?ord=1"><i class="fa fa-caret-up fa-red" title="crescente"></i></a> <a href="VerIPHabilitado.php?ord=1 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="49%" align="center">IP <br><a href="VerIPHabilitado.php?ord=4"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerIPHabilitado.php?ord=4 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
  </tr>
  <? 
    $cnt = 0;
	while ($arr = mysql_fetch_assoc($result)) {
	   $cnt = $cnt + 1;
	   
	   $bgcolor = "#BDE2FF";
  ?>
  <tr > 
    <td width="02%" align="center" <?  echo " bgcolor ='" . $bgcolor . "' ";  ?> > 
      <? echo $cnt; ?>
      </td>
    <td width="30%" align="center" > 
      <? echo $arr["id"]; ?>
      </td>
    <td width="10%" align="center" > 
      <? echo $arr["ip"];  
	    if ( $arr["ip"] <> "" ) {
        # $dados = file_get_contents('http://freegeoip.net/json/'.$arr["ip"]);
		# $parsedJson  = json_decode($dados);
        # {
        #    echo "<BR>".htmlspecialchars($parsedJson->region_name).', '.$parsedJson->region_code;
        # } ;
		};
      ?>	  
      </font></td>

	  </tr>
  <? 
  }
  ?>
</table>
</div>

<br>
 
  <? 
  mysql_free_result($result);
  ?>
  
<br>

<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
	
    if (td) {
   	  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
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

