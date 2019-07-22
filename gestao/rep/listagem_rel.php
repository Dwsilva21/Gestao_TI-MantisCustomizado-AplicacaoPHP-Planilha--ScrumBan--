<?php
include_once('../phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
include_once("../phpjasperxml_0.9d/class/PHPJasperXML.inc.php");
include_once ('listagem_set.php');


$PHPJasperXML = new PHPJasperXML();
//--$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("clienteDe"=>1);
$PHPJasperXML->arrayParameter=array("clienteAte"=>10);
$PHPJasperXML->load_xml_file("listagemDocumentos.jrxml");



$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
//$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
$PHPJasperXML->outpage("I", "sample9.xls");


echo $server . $user . $pass . $db;

//$xml = simplexml_load_file("logEvent.jrxml"); //informe onde está seu arquivo jrxml
//$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=false;
//$descricao=$_GET["descricao"]; //recebendo o parâmetro descrição
//$PHPJasperXML->arrayParameter=array("descricao"=>$descricao); //passa o parâmetro cadastrado no iReport
//$PHPJasperXML->xml_dismantle($xml);
//$PHPJasperXML->connect($server,$user,$pass,$db);
//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
//$PHPJasperXML->outpage("I");

?> 