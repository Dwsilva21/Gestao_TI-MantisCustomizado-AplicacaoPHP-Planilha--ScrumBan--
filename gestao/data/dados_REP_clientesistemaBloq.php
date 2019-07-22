<?php
session_start(); 
include("../library/funcoes.php");

$con = conecta("sac");

$id = str_replace("^","&",$_REQUEST["id"]);
$sis = $_REQUEST["sis"];
$sta = $_REQUEST["sta"];

if ( $sis == "TODOS" ) { $sis = "ATIVO"; };
if ( $sta == "S" ) { $sta = "N"; } else  { $sta = "S"; };

$query1 = "UPDATE cliente_sistemas set " . $sis . " = '" . $sta . "' WHERE id = '" . $id . "' " ;
$result1 = mysqli_query($con,$query1) or die("A consulta falhou : " . mysqli_error($con) . "<BR>" . $query1);


header("Access-Control-Allow-Origin: *");
header( 'Content-Type: text/html; charset=iso-8859-1' );


    $cnt = 0;
    $outp = "";	

	$cnt = $cnt + 1;

   
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"cnt":"'        		 . $cnt    . '",';
    $outp .= '"id":"'      	         . $id     . '",';
    $outp .= '"ip":"'                . $ip     . '"}';
	   
$outp ='{"records":['.$outp.']}';
mysqli_free_result($result);

/*echo($outp);*/
?>
<script>
  window.open('../UnionMnuVert.php?op=1',"_top");  
</script>
