<?
// Transformando arquivo XML em Objeto
$xml = simplexml_load_file('http://www.uniondata.com.br/atualsis/dbupt.xml');




  
    // Percorre todos os itens da venda
	$nver = 0;
	foreach($xml->versao as $item):
	
	  if ($outp != "") {$outp .= ",";}
      $outp .= '{"cnt":"'        		 . $nver                     . '",';
	
      foreach($xml->versao[$nver]->attributes() as $a => $b) { 
	     #echo $b . " "; 
         $outp .= '"' . $a . '":"'        	 . $b  . '",';
	  }
	  
	  foreach($item->sql as $sql) {  
 	     #echo 'Sql: ' . $sql[0] . '<br>'; 
         $outp .= '"sql":"' . $sql[0] . '"}';
	  }
	  $nver += 1;
	  
	endforeach;
  
echo $outp . '<hr>';

?>


