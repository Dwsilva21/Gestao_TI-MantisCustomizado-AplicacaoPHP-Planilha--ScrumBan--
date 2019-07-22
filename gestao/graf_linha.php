<?php
// requisição da classe PHPlot
require_once 'phplot-6.2.0/phplot.php';
include("library/funcoes.php");

$con = Conecta("sac");

$saida    = $_REQUEST["saida"];

$query  = " SELECT  CONCAT(g.value,' Aberto')  AS tipo,  ";
$query .= "  DATE_FORMAT( DATE_ADD(NOW(),INTERVAL -(DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -31 DAY)) ,'%d')) DAY),'%d') Diai, ";
$query .= "  DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -(DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -31 DAY)) ,'%d')) DAY)) ,'%d') Diaf, ";
$query .= "  LOWER(DATE_FORMAT( DATE_ADD(NOW(),INTERVAL -31 DAY),'%M')) Mesi, ";
$query .= "  LOWER( DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -1 DAY)) ,'%M') ) Mesf, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='01'),1,0)) AS Dia01, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='02'),1,0)) AS Dia02, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='03'),1,0)) AS Dia03, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='04'),1,0)) AS Dia04, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='05'),1,0)) AS Dia05, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='06'),1,0)) AS Dia06, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='07'),1,0)) AS Dia07, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='08'),1,0)) AS Dia08, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='09'),1,0)) AS Dia09, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='10'),1,0)) AS Dia10, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='11'),1,0)) AS Dia11, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='12'),1,0)) AS Dia12, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='13'),1,0)) AS Dia13, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='14'),1,0)) AS Dia14, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='15'),1,0)) AS Dia15, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='16'),1,0)) AS Dia16, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='17'),1,0)) AS Dia17, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='18'),1,0)) AS Dia18, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='19'),1,0)) AS Dia19, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='20'),1,0)) AS Dia20, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='21'),1,0)) AS Dia21, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='22'),1,0)) AS Dia22, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='23'),1,0)) AS Dia23, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='24'),1,0)) AS Dia24, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='25'),1,0)) AS Dia25, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='26'),1,0)) AS Dia26, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='27'),1,0)) AS Dia27, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='28'),1,0)) AS Dia28, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='29'),1,0)) AS Dia29, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='30'),1,0)) AS Dia30, ";
$query .= "	 SUM(IF((DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%d')='31'),1,0)) AS Dia31 ";

$query .= "   FROM mantis.mantis_bug_table a   ";
$query .= "    JOIN mantis.mantis_custom_field_string_table g  ON a.id = g.bug_id  ";

$query .= "   WHERE  DATE_FORMAT(FROM_UNIXTIME(a.date_submitted),'%Y-%m-%d') ";
$query .= "    BETWEEN DATE_FORMAT( DATE_ADD(NOW(),INTERVAL -(DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -31 DAY)) ,'%d')) DAY),'%Y-%m-%d') AND  DATE_FORMAT(DATE_ADD(NOW(),INTERVAL -1 DAY),'%Y-%m-%d') ";
$query .= "   AND g.value = 'Erro' ";

$query .= "   GROUP BY  1,2,3,4,5 ";
$query .= " UNION ALL ";
$query .= " SELECT  CONCAT(g.value,' Resolvido') AS tipo, ";
$query .= "  DATE_FORMAT( DATE_ADD(NOW(),INTERVAL -(DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -31 DAY)) ,'%d')) DAY),'%d') Diai, ";
$query .= "  DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -(DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -31 DAY)) ,'%d')) DAY)) ,'%d') Diaf,  ";
$query .= "  DATE_FORMAT( DATE_ADD(NOW(),INTERVAL -31 DAY),'%M') Mesi, ";
$query .= "  DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -1 DAY)) ,'%M') Mesf, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '01'),1,0)) AS Dia01, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '02'),1,0)) AS Dia02, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '03'),1,0)) AS Dia03, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '04'),1,0)) AS Dia04, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '05'),1,0)) AS Dia05, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '06'),1,0)) AS Dia06, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '07'),1,0)) AS Dia07, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '08'),1,0)) AS Dia08, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '09'),1,0)) AS Dia09, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '10'),1,0)) AS Dia10, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '11'),1,0)) AS Dia11, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '12'),1,0)) AS Dia12, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '13'),1,0)) AS Dia13, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '14'),1,0)) AS Dia14, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '15'),1,0)) AS Dia15, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '16'),1,0)) AS Dia16, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '17'),1,0)) AS Dia17, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '18'),1,0)) AS Dia18, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '19'),1,0)) AS Dia19, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '20'),1,0)) AS Dia20, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '21'),1,0)) AS Dia21, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '22'),1,0)) AS Dia22, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '23'),1,0)) AS Dia23, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '24'),1,0)) AS Dia24, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '25'),1,0)) AS Dia25, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '26'),1,0)) AS Dia26, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '27'),1,0)) AS Dia27, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '28'),1,0)) AS Dia28, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '29'),1,0)) AS Dia29, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '30'),1,0)) AS Dia30, ";
$query .= "  SUM(IF((DATE_FORMAT(FROM_UNIXTIME(h.date_modified),'%d') = '31'),1,0)) AS Dia31 ";

$query .= " FROM mantis.mantis_bug_table a ";
$query .= " INNER JOIN mantis.mantis_custom_field_string_table g ON a.id = g.bug_id ";
$query .= " INNER JOIN ";
$query .= " ( SELECT b.bug_id, b.new_value,b.date_modified, DATE_FORMAT(FROM_UNIXTIME(b.date_modified) ,'%Y-%m-%d') dm FROM ( SELECT a.* FROM mantis.mantis_bug_history_table a WHERE a.field_name = 'status' ";
$query .= "           AND a.date_modified = ( SELECT MAX(date_modified) FROM mantis.mantis_bug_history_table WHERE bug_id = a.bug_id AND new_value <> 90 ) ) b  WHERE b.new_value = 80 ) h ON a.id = h.bug_id  ";

$query .= " WHERE  g.value = 'Erro' ";
$query .= " AND h.dm BETWEEN DATE_FORMAT( DATE_ADD(NOW(),INTERVAL -(DATE_FORMAT( LAST_DAY(DATE_ADD(NOW(),INTERVAL -31 DAY)) ,'%d')) DAY),'%Y-%m-%d') AND  DATE_FORMAT(DATE_ADD(NOW(),INTERVAL -1 DAY),'%Y-%m-%d')";

$query .= " GROUP BY 1,2,3,4,5 ";
$query .= " ORDER BY 1,2 ";

$result = mysqli_query($con, $query) or die(mysqli_error($con));


//Define some data
$data = array();

    $cnt = 0;
	$arrA = mysqli_fetch_assoc($result);
	$arrF = mysqli_fetch_assoc($result);
	
	$priD = $arrA["Diai"];
	$ultD = $arrA["Diaf"];
	$priM = substr($arrA["Mesi"],0,3);
	$ultM = substr($arrA["Mesf"],0,3);
	$totA = 0;
	$totF = 0;
	$totS = 0;
	
    for($i =1; $i <= $ultD ; $i++){    
	     $dia   = substr('0' . $priD , -2);
		 $totA += $arrA["Dia" . $dia];
		 $totF += $arrF["Dia" . $dia];

         $outro = array( $priD . $priM , $arrA["Dia" . $dia] , $arrF["Dia" . $dia], $arrA["Dia" . $dia] - $arrF["Dia" . $dia] );
         array_push($data, $outro );

		 $priD  += 1;
		 if ( $priD > $ultD ) { 
		      $priD = 1; 
			  $priM = $ultM;
	     }
		 
    };
	
 		 
# Cria um novo objeto do tipo PHPlot com 500px de largura x 350px de altura                 
$plot = new PHPlot(1200 , 500, '/var/www/vhosts/uniondata.com.br/httpdocs/gestao/phplot-6.2.0/grafico_mantis.png');     


 
// Organiza Gráfico -----------------------------
$plot->SetTitle("Comparativo diário de chamados de ERROS\n " . substr($arrA["Mesi"],0,3) . "-" . substr($arrA["Mesf"],0,3) );
# Precisão de uma casa decimal
$plot->SetPrecisionY(1);
# tipo de Gráfico em barras  
$plot->SetPlotType("linepoints");
# Tipo de dados que preencherão  
$plot->SetDataType("text-data");
# Adiciona ao gráfico os valores do array
$plot->SetDataValues($data);

 $totS = $totA - $totF;
 $plot->SetDataColors(array('red', 'green', 'orange'));
 $plot->SetLegend('Abertos = ' . $totA ) ;
 $plot->SetLegend('Resolvidos = ' . $totF ) ;
 $plot->SetLegend('Saldo = ' . $totS ) ;
 $plot->SetLegendPosition(0.5, 0, 'title', 0.5, 1);
 $plot->SetMarginsPixels(60, null, 120,null);
// -----------------------------------------------


// Organiza eixo X ------------------------------
# Seta os traços (grid) do eixo X para invisível
$plot->SetXTickPos('none');
# Texto abaixo do eixo X
$plot->SetXLabel("Fonte: Uniondata - MANTIS");
# Tamanho da fonte que varia de 1-5
$plot->SetXLabelFontSize(2);
$plot->SetAxisFontSize(2);
// -----------------------------------------------
  
// Organiza eixo Y -------------------------------
# Coloca nos pontos os valores de Y
$plot->SetYDataLabelPos('plotin');
// -----------------------------------------------

// Desenha o Gráfico -----------------------------
if ( $saida != 'tela' ) {
   $plot->SetPrintImage(False);
};
$plot->DrawGraph();
// -----------------------------------------------
//echo $query . '<br>';
mysqli_free_result($result);


?>