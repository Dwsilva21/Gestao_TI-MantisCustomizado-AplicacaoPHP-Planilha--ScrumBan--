<?
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { ?> <script> parent.window.location.href ="UnionMnuVert.php" </script> <? }

include("data/conecta3307.php");

#require_once("../cliente/mantisbt/lang/strings_portuguese_brazil.txt");
$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
require_once("../cliente/mantisbt/config_defaults_inc.php");
require_once("../cliente/mantisbt/config_inc.php");

$id = $_REQUEST["id"];
$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "10 desc";
};
$query = "SELECT a.cliente,a.sistema,a.programa,a.rotina,a.descricao,a.linha,a.numero,a.data,a.usuario,a.sequencial,a.ip, a.mantis, b.id local,b.ip as ipexc, c.status ";
$query .= " FROM logerro a ";
$query .= " LEFT JOIN cliente_ip_bloqueado    b ON a.ip = b.ip  ";
$query .= " LEFT JOIN mantis.mantis_bug_table c ON a.mantis = c.id ";
$query .= " WHERE a.cliente = '" . $id . "' and data > '2017-06-01' and not ( a.mantis = 0 and  b.ip is not null ) ";
$query .= "   AND a.mantis NOT in ( select id FROM mantis.mantis_bug_table where status in (80,90)) ";
$query .= " ORDER BY " . $ordem ;
#. " limit 100 ";
$result = mysql_query($query) or die("A consulta falhou : " . mysql_error());
?>

<html>
<head>
<title>Erros dos Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="sortcut icon" href="image/favicon.ico" type="image/x-icon" />


</head>
<a href="VerCli.php">

<div class="w3-container">

<div class="w3-padding w3-large w3-text-black">
    <i class="material-icons w3-xlarge" title="Voltar">home</i>
</div>
</a>

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr class="w3-light-grey">
    <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Erros ] <? echo $id ?> </em></b></font></td>
  </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
  <tr bgcolor="#5555FF" class="w3-green"> 
    <td width="02%" align="center">Nº</td>
    <td width="10%" align="center">Sistema <br><a href="VerErros.php?id=<? echo $id ?>&ord=2"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=2 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Programa <br><a href="VerErros.php?id=<? echo $id ?>&ord=3"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=3 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Rotina <br><a href="VerErros.php?id=<? echo $id ?>&ord=4"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=4 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="30%" align="center">Descrição <br><a href="VerErros.php?id=<? echo $id ?>&ord=5"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=5 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="02%" align="center">Linha <br><a href="VerErros.php?id=<? echo $id ?>&ord=6"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=6 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="02%" align="center">Numero <br><a href="VerErros.php?id=<? echo $id ?>&ord=7"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=7 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">Data <br><a href="VerErros.php?id=<? echo $id ?>&ord=8"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=8 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="04%" align="center">Usuário <br><a href="VerErros.php?id=<? echo $id ?>&ord=9"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=9 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">Sequencial <br><a href="VerErros.php?id=<? echo $id ?>&ord=10"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=10 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="10%" align="center">ip <br><a href="VerErros.php?id=<? echo $id ?>&ord=11"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=11 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
    <td width="05%" align="center">MANTIS <br><a href="VerErros.php?id=<? echo $id ?>&ord=12"><i class="fa fa-caret-up" title="crescente"></i></a> <a href="VerErros.php?id=<? echo $id ?>&ord=12 desc"><i class="fa fa-caret-down" title="descrescente"></i></a></td>
  </tr>
  <? 
    $cnt = 0;
	while ($arr = mysql_fetch_assoc($result)) {

  	   $cnt = $cnt + 1;
	   
	   $bgcolor = "#BDE2FF";

  ?>
  <tr> 
    <td width="02%" align="center"  >  
      <? echo $cnt; ?>
      </td>
    <td width="10%" align="center"  >  
      <? echo $arr["sistema"]; ?>
      </td>
    <td width="10%" align="center"  >  
      <? echo $arr["programa"]; ?>
      </td>
    <td width="10%" align="center"  >  
      <? echo $arr["rotina"]; ?>
      </td>
    <td width="30%" align="center"  >  
      <? echo $arr["descricao"]; ?>
      </td>
    <td width="02%" align="center"  >  
      <? echo $arr["linha"]; ?>
      </td>
    <td width="02%" align="center"  >  
      <? echo $arr["numero"]; ?>
      </td>
    <td width="10%" align="center"  >  
      <? echo $arr["data"]; ?>
      </td>
    <td width="04%" align="center"  >  
      <? echo $arr["usuario"]; ?>
      </td>
    <td width="05%" align="center"  >  
      <? echo $arr["sequencial"]; ?>
      </td>
    <td width="10%" align="center"  >  
      <? echo $arr["ip"]; ?>
	  
	  <?
	    if ( $arr["ipexc"] <> "" )  { 
	      echo "<br><span class='w3-tag w3-red w3-small'>[bloqueado]" . $arr["local"] . "</span>"; 
		 } 
	  ?>
    </td>

	<? 
	  if ( $arr["mantis"] > 0 ) { 
     	  $label   = substr( $g_status_enum_string, strpos($g_status_enum_string,$arr["status"])+3 , strpos($g_status_enum_string,",",strpos($g_status_enum_string,$arr["status"]))-strpos($g_status_enum_string,$arr["status"])-3 ) ;
     	  $labelBR = substr( $s_status_enum_string, strpos($s_status_enum_string,$arr["status"])+3 , strpos($s_status_enum_string,",",strpos($s_status_enum_string,$arr["status"]))-strpos($s_status_enum_string,$arr["status"])-3 ) ;
		  
		  
     	  $color = $g_status_colors[ $label ];
          echo "<td width='05%' align='center' title='" . $labelBR . "'  bgcolor='" . $color . "'>";
    	  echo "<a href='http://uniondata.com.br/cliente/mantisbt/view.php?id=" . $arr["mantis"] . "' target='_blank'>" ; 
          echo $arr["mantis"];		  
	      echo "</a>"; 
	      echo "</td>"; 
	  } else { 
          echo "<td width='05%' align='center' >";
	      echo "<span title='sem MANTIS' class='w3-badge   w3-red'>"; 
          echo $arr["mantis"];		
          echo "</span>";		  
	      echo "</td>"; 
      } 
    ?>

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


</body>
</html>

