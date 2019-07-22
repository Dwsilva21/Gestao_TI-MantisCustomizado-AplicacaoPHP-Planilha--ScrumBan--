<?php
session_start(); 
ini_set('default_charset','iso-8859-1');
if ( $_SESSION['acs'] == "999" || $_SESSION['acs'] == "" ) 
{  header ( 'Location: nada.htm' ); 
   die(); 
}

include("library/funcoes.php"); 
include("library/ambiente.php");

$con = conecta("sac");

require_once("../cliente/mantisbt/config_defaults_inc.php");
require_once("../cliente/mantisbt/config_inc.php");

$ordem1 = $_REQUEST["ord1"];
if ($ordem1 == "" ) { 
    $ordem1 = "1 ";
};
$ordem2 = $_REQUEST["ord2"];
if ($ordem2 == "" ) { 
    $ordem2 = "1 ";
};

$query1  = "SELECT a.id, b.razao, a.motivo, a.sistema, a.descricao, a.programa, a.analista, a.datahora_cadastro, a.nome_contato, a.fone_contato, a.email_contato, c.qtde, TIMESTAMPDIFF( MINUTE, a.datahora_cadastro, NOW()) minutos, d.bug_id as mantis, e.status, IFNULL(f.value,'00.00.00') versaoexe , IFNULL(g.qtanexo,0) qtanexo ";
$query1 .= " FROM ocorrencia_Atendimento a ";
$query1 .= " INNER JOIN cliente    b ON a.cliente = b.id ";
$query1 .= " LEFT  JOIN ( select chamado,count(*) qtde from logchamado group by chamado ) c ON a.id = c.chamado ";

$query1 .= " LEFT  JOIN mantis.mantis_custom_field_string_table d ON instr(d.value,a.id) and d.field_id = 14 ";
$query1 .= " LEFT  JOIN mantis.mantis_bug_table e ON d.bug_id  = e.id ";
$query1 .= "  LEFT  JOIN mantis.mantis_custom_field_string_table f ON d.bug_id  = f.bug_id AND f.field_id = 17 ";
$query1 .= " LEFT  JOIN ( select idchamado, count(*) qtanexo from anexo group by idchamado ) g ON a.id  = g.idchamado ";


$query1 .= " WHERE a.concluido = 0 and isnull(a.analista) ";
$query1 .= " ORDER by " . $ordem1 ;
$result1 = mysqli_query($con,$query1) or die("A consulta falhou : " . mysqli_error($con));

?>

<html>
<head>
<title>Atendimento a Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META HTTP-EQUIV="REFRESH" CONTENT="300;URL="VerAtendimento.php?ord1=<?php echo $ordem1; ?>&ord2=<?php echo $ordem2; ?>"> 


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

<!--
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>Atendimento a Clientes</em></b></font></td>
  </tr>
</table>
-->
<br>
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-centered">
  <tr class="w3-light-blue">
    <td colspan="6" align="center">AGUARDANDO ATENDIMENTO</td>
  </tr>
</table>

<div class="w3-row">
  <div class="w3-col w3-container" style="width:85%">
  <input class="w3-input w3-border w3-padding" type="text" placeholder="Digite aqui : ID,Cliente,Motivo,Sistema,Descrição,MANTIS,Programa,Data ou Contato.." id="myInput1" onkeyup="myFunction1()"></div>
  <div class="w3-col w3-container" style="width:15%"><input class="w3-input w3-border w3-padding" type="button" placeholder="Procurar por Código.." id="myButton1" value="Detalhar ID" onclick="chamaID()"></div>
</div>

  
<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny" id="myTable1">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="02%" align="center">ID <br><a href="VerAtendimento.php?ord1=1<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=1 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="15%" align="center">Cliente <br><a href="VerAtendimento.php?ord1=2<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=2 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Motivo <br><a href="VerAtendimento.php?ord1=3<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=3 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Sistema <br><a href="VerAtendimento.php?ord1=4<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=4 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="35%" align="center">Descrição <br><a href="VerAtendimento.php?ord1=5<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=5 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">MANTIS <br><a href="VerAtendimento.php?ord1=14<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=14 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Programa <br><a href="VerAtendimento.php?ord1=6<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=6 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Mensagens <br><a href="VerAtendimento.php?ord1=7<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=7 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Data <br><a href="VerAtendimento.php?ord1=8<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=8 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Contato <br><a href="VerAtendimento.php?ord1=9<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=9 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="06%" align="center">Telefone <br><a href="VerAtendimento.php?ord1=11<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord1=11 desc<?php echo "&ord2=" . $ordem2 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
  </tr>
  <?php 
    $cnt = 0;
	while ($arr = mysqli_fetch_assoc($result1)) {
	   $cnt = $cnt + 1;
	   
  	 $label   = "";
	   $labelBR = "";
	   $color   = "";
	   $mantis  = "";
	   if ( $arr["mantis"] > 0 )
	   {
	      $mantis  = $arr["mantis"];
		  $g_stat  = $g_status_enum_string . "," ;
          $label   = substr( $g_stat, strpos($g_stat,$arr["status"])+3 , strpos($g_stat,",",strpos($g_stat,$arr["status"]))-strpos($g_stat,$arr["status"])-3 ) ;
		  $g_staBR = $s_status_enum_string . "," ; 
          $labelBR = substr( $g_staBR, strpos($g_staBR,$arr["status"])+3 , strpos($g_staBR,",",strpos($g_staBR,$arr["status"]))-strpos($g_staBR,$arr["status"])-3 ) ;
          $color = $g_status_colors[ $label ];
	   };


       $query2  = "SELECT a.responsavel nome, a.datahora, a.descricao, a.motivoenc ";
       $query2 .= " FROM logchamado a ";
       $query2 .= " WHERE a.chamado = " . $arr["id"] ;
       $query2 .= "   and a.datahora = ( SELECT MAX(datahora) from logchamado where chamado = "  . $arr["id"] . " GROUP by chamado )";
       $result2 = mysqli_query($con,$query2) or die("A consulta falhou : " . mysqli_error($con));
   
	   $title = "";
       while ($arr2 = mysqli_fetch_assoc($result2)) {
          $title = $arr2["datahora"] . chr(13) . $arr2["descricao"] . chr(13) . $arr2["motivoenc"] . $arr2["nome"] ;
	    }
?>
  
  
  <tr <?php if ( (int)$arr["minutos"] > (60*24*3) ) { echo "class='w3-hoverable w3-text-red'"; } ?> title="<?php echo $title ?>"> 
	  
 
	  <td width="02%" align="center" ><?php echo $cnt; ?></td>
 
      <td width="02%" align="center" > 
      <a href="VerChamado.php?id=<?php echo $arr["id"]; ?>"> <?php if ( (int)$arr["minutos"] > (60*24*3) ) { echo "<span class='w3-badge w3-red'>"; }?> <?php echo $arr["id"]; ?></span> </a>
	  <?php  if ( $arr["qtanexo"] > 0 ) {  echo "<br>" . $arr["qtanexo"] . "<img src='image/clips.jpg'>" ; } ?>
      </td>

      <td width="15%" align="center" >
	  <a href="VerCliente.php?id=<?php echo urlencode($arr["razao"]); ?>"><?php echo $arr["razao"]; ?> </a></td>
	  
      <td width="05%" align="center" ><?php if ( $arr["motivo"]=="Erro em sistema" ) { echo "<span class='w3-tag w3-red'>"; }?><?php echo $arr["motivo"]; ?><?php if ( $arr["motivo"]=="Erro em sistema" ) { echo "</span>";} ?></td>
      
	  <td width="05%" align="center" ><?php echo $arr["sistema"]; ?></td>
	  
      <td width="35%" align="center" ><?php echo $arr["descricao"]; ?></td>
	  
      <td width="05%" align="center" title="<?php echo $labelBR; ?>" bgcolor="<?php echo $color ;?>" >
	  <a href="http://uniondata.com.br/cliente/mantisbt/view.php?id=<?php echo $arr["mantis"]; ?>" target="_blank"> <?php echo $arr["mantis"]; ?> <br> <?php if ( $arr["versaoexe"] <> '00.00.00' ) { echo "v." . $arr["versaoexe"]; } ?></a></td>

      <td width="05%" align="center" ><?php echo $arr["programa"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["analista"]; ?></td>
	  
      <td width="10%" align="center" ><?php echo $arr["datahora_cadastro"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["nome_contato"]; ?></td>
	  
      <td width="06%" align="center" ><?php echo $arr["fone_contato"]; ?></td>

	  </tr>

  <?php 
  }
  ?>
</table>

 	  
<br>

<?php
$query2  = "SELECT a.id, b.razao, a.motivo, a.sistema, a.descricao, c.status manstatus, a.programa, c.responsavel analista, a.datahora_cadastro, a.nome_contato, a.fone_contato, a.email_contato, d.bug_id as mantis, e.status, IFNULL(f.value,'00.00.00') versaoexe, IFNULL(g.qtanexo,0) qtanexo  ";
$query2 .= " FROM ocorrencia_Atendimento a ";
$query2 .= " INNER JOIN cliente    b ON a.cliente = b.id ";
$query2 .= " INNER JOIN logchamado c ON a.id      = c.chamado ";
$query2 .= " LEFT  JOIN mantis.mantis_custom_field_string_table d ON instr(d.value,a.id) and d.field_id = 14 ";
$query2 .= " LEFT  JOIN mantis.mantis_bug_table e ON d.bug_id  = e.id ";
$query2 .= "  LEFT  JOIN mantis.mantis_custom_field_string_table f ON d.bug_id  = f.bug_id AND f.field_id = 17 ";
$query2 .= " LEFT  JOIN ( select idchamado, count(*) qtanexo from anexo group by idchamado ) g ON a.id  = g.idchamado ";

$query2 .= " WHERE a.concluido = 0 and a.analista is not null ";
$query2 .= "   and c.id = ( select max(id) from logchamado where chamado = a.id group by chamado )";
$query2 .= " ORDER by " . $ordem2 ;
$result2 = mysqli_query($con,$query2) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query2 );
#echo $query2;
?>

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-centered">
  <tr class="w3-light-blue">
    <td colspan="6" align="center">EM ATENDIMENTO</td>
  </tr>
</table>



<input class="w3-input w3-border w3-padding" type="text" placeholder="Digite aqui: Cliente,Motivo,Sistema,Descrição,Programa,Analista ou Contato.." id="myInput2" onkeyup="myFunction2()">

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable w3-tiny" id="myTable2">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center"><b>Nº</b></td>
    <td width="02%" align="center">ID <br><a href="VerAtendimento.php?ord2=1<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=1 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="15%" align="center">Cliente <br><a href="VerAtendimento.php?ord2=2<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=2 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Motivo <br><a href="VerAtendimento.php?ord2=3<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=3 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Sistema <br><a href="VerAtendimento.php?ord2=4<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=4 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="25%" align="center">Descrição <br><a href="VerAtendimento.php?ord2=5<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=5 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">MANTIS <br><a href="VerAtendimento.php?ord2=12<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=12 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Status <br><a href="VerAtendimento.php?ord2=6<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=6 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Programa <br><a href="VerAtendimento.php?ord2=7<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=7 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Analista <br><a href="VerAtendimento.php?ord2=8<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=8 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Data <br><a href="VerAtendimento.php?ord2=9<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=9 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Contato <br><a href="VerAtendimento.php?ord2=10<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=10 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="06%" align="center">Telefone <br><a href="VerAtendimento.php?ord2=11<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerAtendimento.php?ord2=11 desc<?php echo "&ord1=" . $ordem1 ?>"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
  </tr>
  <?php 
    $cnt = 0;
	while ($arr = mysqli_fetch_assoc($result2)) {
	   $cnt = $cnt + 1;
  
  	 $label   = "";
	   $labelBR = "";
	   $color   = "";
	   $mantis  = "";
	   if ( $arr["mantis"] > 0 )
	   {
	      $mantis  = $arr["mantis"];
		  $g_stat  = $g_status_enum_string . "," ;
          $label   = substr( $g_stat, strpos($g_stat,$arr["status"])+3 , strpos($g_stat,",",strpos($g_stat,$arr["status"]))-strpos($g_stat,$arr["status"])-3 ) ;
		  $g_staBR = $s_status_enum_string . "," ; 
          $labelBR = substr( $g_staBR, strpos($g_staBR,$arr["status"])+3 , strpos($g_staBR,",",strpos($g_staBR,$arr["status"]))-strpos($g_staBR,$arr["status"])-3 ) ;
          $color = $g_status_colors[ $label ];
	   };


  
  
  
       $query3  = "SELECT a.responsavel nome, a.datahora, a.descricao, a.motivoenc ";
       $query3 .= " FROM logchamado a ";
       $query3 .= " WHERE a.chamado = " . $arr["id"] ;
       $query3 .= "   and a.datahora = ( SELECT MAX(datahora) from logchamado where chamado = "  . $arr["id"] . " GROUP by chamado )";
       $result3 = mysqli_query($con,$query3) or die("A consulta falhou : " . mysqli_error($con));
   
	   $title = "";
       while ($arr2 = mysqli_fetch_assoc($result3)) {
          $title = $arr2["datahora"] . chr(13) . $arr2["descricao"] . chr(13) . $arr2["motivoenc"] . $arr2["nome"] ;
	    }
?>
  <tr  title="<?php echo $title ?>"> 
	  
 
	  <td width="02%" align="center" ><?php echo $cnt; ?></td>
 
      <td width="02%" align="center" ><a href="VerChamado.php?id=<?php echo $arr["id"]; ?>"> <?php echo $arr["id"]; ?> </a>
	  <?php  if ( $arr["qtanexo"] > 0 ) {  echo "<br>" . $arr["qtanexo"] . "<img src='image/clips.jpg'>" ; } ?>
	  </td>

      <td width="15%" align="center" >
	  <a href="VerCliente.php?id=<?php echo urlencode($arr["razao"]); ?>"><?php echo $arr["razao"]; ?> </a></td>
	  
      <td width="05%" align="center" ><?php if ( $arr["motivo"]=="Erro em sistema" ) { echo "<span class='w3-tag w3-red'>"; }?><?php echo $arr["motivo"]; ?><?php if ( $arr["motivo"]=="Erro em sistema" ) { echo "</span>";} ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["sistema"]; ?></td>
	  
      <td width="25%" align="center" ><?php echo $arr["descricao"]; ?></td>
      <td width="05%" align="center" title="<?php echo $labelBR; ?>" bgcolor="<?php echo $color ;?>" >
	  <a href="http://uniondata.com.br/cliente/mantisbt/view.php?id=<?php echo $arr["mantis"]; ?>" target="_blank"> <?php echo $arr["mantis"]; ?> <BR> <?php if ( $arr["versaoexe"] <> '00.00.00' ) { echo "v." . $arr["versaoexe"]; }  ?></a></td>

	  
      <td width="10%" align="center" ><?php echo $arr["manstatus"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["programa"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["analista"]; ?></td>
	  
      <td width="10%" align="center" ><?php echo $arr["datahora_cadastro"]; ?></td>
	  
      <td width="05%" align="center" ><?php echo $arr["nome_contato"]; ?></td>
	  
      <td width="06%" align="center" ><?php echo $arr["fone_contato"]; ?></td>

	  </tr>

  <?php 
  }
  ?>
</table>

 
</div>

<br>

 
  <?php 
  mysqli_free_result($result3);
  ?>
  
<br>

<script>

function myFunction1() {
  var input, filter, table, tr, td1, td2, td3, td4, td5, td6, td7, td8, td9, i;
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
    td8 = tr[i].getElementsByTagName("td")[9];
    td9 = tr[i].getElementsByTagName("td")[10];
	
    if ((td1) || (td2) || (td3) || (td4) || (td5) || (td6) || (td7) || (td8) || (td9)) {
   	  if ((td1.innerHTML.toUpperCase().indexOf(filter) > -1) || 
	      (td2.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td3.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td4.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td5.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td6.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td7.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td8.innerHTML.toUpperCase().indexOf(filter) > -1) ||
	      (td9.innerHTML.toUpperCase().indexOf(filter) > -1)   ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  
  document.getElementById("myInput2").value = document.getElementById("myInput1").value;
  myFunction2();
  
}

function myFunction2() {
  var input, filter, table, tr, td1, td2, td3, td4, td5, td6, td7, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    td5 = tr[i].getElementsByTagName("td")[5];
    td6 = tr[i].getElementsByTagName("td")[6];
    td7 = tr[i].getElementsByTagName("td")[8];
	
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

function chamaID()
{
	input = document.getElementById("myInput1");
	url = "VerChamado.php?id=" + input.value ;
	window.open( url ,"iframe_a")
}

</script>

</body>
</html>

