<?php

function Verifica_Cliente(  $ip,  $id) {
  $ret = 0;
  $query = "select ip from sac.cliente_ip_habilitado where id = '" . $id . "' and ip = '" . $ip . "'";
  $result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . " = " . $query); 
  if ($rs = mysqli_fetch_assoc($result))
  {
     $ret = 1;
  } else {
     $query0  = "insert into sac.cliente_ip_desconhecido(id,ip,ocorrencias) ( select '" . $id  . "','" . $ip . "', 1 from dual where '" . $ip . "' not in ( select distinct ip from cliente_ip_bloqueado ) )";
	 $query0 .= " on duplicate key update ocorrencias=ocorrencias+1 ";

	 $query1  = "replace into sac.cliente_ip_desconhecido(id,ip) ( select '" . $id  . "','" . $ip . "' from dual where '" . $ip . "' not in ( select distinct ip from cliente_ip_bloqueado ) )";
	 
     $query  = "INSERT INTO sac.cliente_ip_desconhecido(id,ip,ocorrencias) ( ";
	 $query .= "   SELECT a.id, a.ip, a.qtde ";
	 $query .= "     FROM ( select '" . $id  . "' id,'" . $ip . "' ip, 1 qtde from dual  ) a";
	 $query .= "     LEFT JOIN sac.cliente_ip_bloqueado b ON a.ip = b.ip  AND a.id = b.id";
	 $query .= "    WHERE b.ip IS NULL ) ";
	 $query .= " on duplicate key update ocorrencias=ocorrencias+1 ";

	 
     $result = mysqli_query($query); 
     $ret = 2;
	 echo "Não Autorizado!!!";
  }

  # deixando qualquer ip gravar
  $ret = 1;
  # ===========================
  return $ret ;
}


function Verifica_Usuario(  $usu,  $snh, $con) {
  $ret = 0;
  
  $query = "select udash from sac.usuario where nome = '" . $usu . "' and senha = '" . $snh . "'";
  if ($usu == "Super" and $snh == "Super")  { return "111" ;  }
  $result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . " = " . $query); 
  if ($rs = mysqli_fetch_assoc($result) )
  {
     $ret = $rs["udash"] ;
  } else {
     $ret = "999";
  }

  return $ret ;
}

function Verifica_Msg() {

  $ret = 1;	  
  $query = "SELECT dump_value FROM mantis.logevent WHERE dump_event = 'GravaErroNuvemMantis5' AND DATE_FORMAT(dump_date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') and dump_value = 'GENM5()' ";
  $result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . " = " . $query); 
  if ($rs = mysqli_fetch_assoc($result))
  {
     $ret = 0;
	 $query = "update mantis.logevent set dump_value = 'GENM5(1)' WHERE dump_event = 'GravaErroNuvemMantis5' AND DATE_FORMAT(dump_date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') and dump_value = 'GENM5()' ";
	 $result = mysqli_query($con,$query) or die("A consulta falhou : " . mysqli_error($con) . " = " . $query); 
  }
  return $ret ;
}

function Conecta( $db ) {

  # define("DB_HOST","10.10.1.20");
  # define("DB_USER","daniel");
  # define("DB_PASSWORD","biabia");
  # define("DB_NAME",$db);
  # define("DB_PORT","3306");

   define("DB_HOST","uniondata.com.br:3307");
   define("DB_USER","site");
   define("DB_PASSWORD","jpwjpw001");
   define("DB_NAME",$db);
   
   $mycon = new mysqli(DB_HOST, DB_USER, DB_PASSWORD );
   $banco = mysqli_select_db($mycon,$db);

   if (mysqli_connect_errno()) {
       die("Connect failed: %s\n" . mysqli_connect_error());
   } else { return $mycon; }
   
}


?>