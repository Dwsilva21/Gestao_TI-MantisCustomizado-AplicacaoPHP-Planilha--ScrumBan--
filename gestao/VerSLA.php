<?php
ini_set('default_charset','iso-8859-1');
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) {  header ( 'Location: UnionMnuVert.php' ); }

include("library/conecta3307mantis.php");

$ordem1 = $_REQUEST["ord1"];
if ($ordem1 == "" ) { 
    $ordem1 = "1,2,3 ";
};
$xls = $_REQUEST["xls"];

$query1  = "SELECT * FROM mantis.sla_nuvem ";
$query1 .= " ORDER by " . $ordem1 ;

$result = mysqli_query($con,"CALL GeraSLAAnual('2018-01','2018-12');") or die("Erro na query da procedure: " . mysqli_error($con));

$query1  = "SELECT * FROM mantis.sla_nuvem;";
$result1 = mysqli_query($con,$query1) or die("A consulta falhou : " . mysqli_error($con));

if ( $xls <> "" ) {
   $arquivo = 'planilha.xls';	
// Configurações header para forçar o download
   header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
   header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
   header ("Cache-Control: no-cache, must-revalidate");
   header ("Pragma: no-cache");
   header ("Content-type: application/x-msexcel");
   header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
   header ("Content-Description: PHP Generated Data" );
}


?>

<html>
<head>
<title>SLA</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<style>
html, body, h1, h2, h3, h4, h5, h6 {
  font-family: "Verdana", cursive, sans-serif;
}
</style>



</head>

<div class="w3-container">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Estatistica de Tempo</em></b></font> </td>
  </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-centered">
  <tr class="w3-light-blue">
    <td colspan="6" align="center">SLA</td>
  </tr>
</table>

		
<table width="100%"><tr>
<td width="5%" align="center"><a href="VerSLA.php?xls=1" title="Gerar EXCEL"><img src="image/excel.jpg"></a></td><td width="95%"><input class="w3-input w3-border w3-padding" type="text" placeholder="Procurar por Projeto,Programa,Tipo,Grupo,Minutos,Acrescimo.." id="myInput1" onkeyup="myFunction1()"></td>
</tr></table>

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny" id="myTable1">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="05%" align="center"><b>Nº</b></td>
    <td width="15%" align="center">Projeto <br><a href="VerSLA.php?ord1=2<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=2 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="30%" align="center">Programa<br><a href="VerSLA.php?ord1=3<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=3 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Tipo <br><a href="VerSLA.php?ord1=4<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=4 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="20%" align="center">Grupo <br><a href="VerSLA.php?ord1=5<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=5 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Minutos <br><a href="VerSLA.php?ord1=14<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=14 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Acrescimo <br><a href="VerSLA.php?ord1=6<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=6 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Qtde <br><a href="VerSLA.php?ord1=7<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=7 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">SLA <br><a href="VerSLA.php?ord1=8<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerSLA.php?ord1=8 desc<?php echo "&ord1=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
  </tr>
  <?php 
    $cnt = 0;
	while ($arr = mysqli_fetch_assoc($result1)) {
	   $cnt = $cnt + 1;

	   $minutos_totais = round(($arr["min_grupo"]+$arr["acrescimo_nao_nuvem"])/$arr["qtde"],0) ;
	   $horas = floor($minutos_totais / 60);
       $minutos = $minutos_totais % 60;  
	   
	 ?>
  
  
  <tr <?php if ( (int)$arr["minutos"] > (60*24*3) ) { echo "class='w3-hoverable w3-text-red'"; } ?> title="<?php echo $title ?>"> 
	  
 
	  <td width="05%" align="center" ><?php echo $cnt; ?></td>
 
      <td width="15%" align="center" ><?php echo $arr["project"]; ?></td>
	  
	  <td width="30%" align="center" ><?php echo $arr["steps_to_reproduce"]; ?></td>
	  
      <td width="10%" align="center" ><?php echo $arr["type"]; ?></td>
	  
      <td width="20%" align="center" ><?php echo $arr["grupo"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["min_grupo"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["acrescimo_nao_nuvem"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["qtde"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $horas . ":" . str_pad($minutos,2,"0",STR_PAD_LEFT) ; ?></td>
	  

	  </tr>

  <?php 
  }
  mysqli_free_result($result1);
  ?>
</table>
</div>

<script>

function myFunction1() {
  var input, filter, table, tr, td1, td2, td3, td4, td5, td6, td7 , i;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable1");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    td5 = tr[i].getElementsByTagName("td")[5];
    td6 = tr[i].getElementsByTagName("td")[6];
    td7 = tr[i].getElementsByTagName("td")[7];
	
    if ((td1) || (td2) || (td3) || (td4) || (td5) || (td6) || (td7) ) {
   	  if ((td1.innerHTML.toUpperCase().indexOf(filter) > -1) || 
	      (td2.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td3.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td4.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td5.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td6.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td7.innerHTML.toUpperCase().indexOf(filter) > -1)  ) {
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

