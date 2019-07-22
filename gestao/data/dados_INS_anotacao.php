<?php
ini_set('default_charset','iso-8859-1');

session_start(); 
include("../library/funcoes.php");
include("../library/ambiente.php");

$con = conecta("sac");

$digid  = $_POST["digid"];
$digdes = $_POST["digdes"];
$digmot = $_POST["digmot"];
$digsta = $_POST["digsta"];
$dighor = $_POST["dighor"];
$digenv = $_POST["digenv"];
$digana = $_POST["digana"];
$url = "";

    $query0  = "INSERT into logchamado(chamado,responsavel,descricao,motivoenc,status,tempo,email_enviado,origem) values( '" . $digid . "','" . $_SESSION['usr'] . "','" . $digdes . "','" . $digmot . "','" . $digsta . "','" . $dighor . "','" . $digenv . "','U' )";
    $result0 = mysqli_query($con,$query0) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query0); 

	// echo $query0;
	$url = "../VerChamado.php?id=" . $digid ;
	if ($digenv == "S" || $digsta == "FINALIZADO") { $url = "../MsgAtendimento.php?id=" . $digid; }
	
	
	$query1  = "UPDATE ocorrencia_Atendimento set datahora_alteracao = now(), analista = '" . $_SESSION['usr'] . "' ";
	if ( $digsta == "FINALIZADO" ) { $query1 .= " , encerrado = 1 , concluido = 1 "; }
 	$query1 .= " where id = " . $digid ;
	 
    $result1 = mysqli_query($con,$query1) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query1); 
    // echo $url;
    
?>
<script>
  // alert("<? echo $digana ?>");
  // alert("<? echo $url ?>");
  window.open("<? echo $url ?>","iframe_a");  
</script>
