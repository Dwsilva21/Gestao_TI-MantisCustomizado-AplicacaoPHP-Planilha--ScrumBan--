<?php
session_start();

$s_status_enum_string = '10:novo,20:retorno,25:analisar,30:autorizado,40:teste,50:atribuído,55:compilar,60:aguarde,80:resolvido,90:fechado';
$myold = array( chr(10), chr(13), chr(34), chr(39) , chr(8), "	" , chr(44) , chr(24), chr(195), "", chr(92) );
$mynew = array(      "",     " ",     "`",    "``" ,     "",   "" ,      ";", " ", " ", " ", "-" );
$_SESSION['acs'] = "111"

?>