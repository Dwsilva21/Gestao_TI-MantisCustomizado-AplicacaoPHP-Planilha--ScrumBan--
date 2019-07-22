<?
// Transformando arquivo XML em Objeto
$xml = simplexml_load_file('http://www.uniondata.com.br/atualsis/dbupt.xml');
  
    // Percorre todos os itens 
	$nver  = 0;
	$outp  = "";
	$outp1 = "";
	$outp2 = "";
	$outp3 = "";
	$troca = "";
	$mysql = "";
	$myold = array( chr(10), chr(13), chr(34), chr(39)  );
	$mynew = array( "", " ", "`", "``"  );
	$cnt   = 0;
	
	foreach($xml->versao as $item):
	
      $outp1 = '{"cnt":"'  . "xxx" . '",';
	
	  $outp2 = "";
      foreach($xml->versao[$nver]->attributes() as $a => $b) { 
         $outp2 .= '"' . $a . '":"'        	 . $b  . '",';
	  }
	  
	  foreach($item->sql as $sql) {  
         $cnt += 1;
   	     if ($outp != "") {$outp .= ",";}
		 $mysql = str_replace($myold,$mynew,$sql[0]) ;
		 $outp3 = str_replace("xxx",$cnt,$outp1);
         $outp .= $outp3 . $outp2 . '"sql":"' . urlencode($mysql) . '"}';
	  }
	  $nver += 1;
		  
	  
	endforeach;
  
$outp ='{"records":['.$outp.']}';
echo($outp);

?>


