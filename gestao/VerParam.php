<?


$par1= $_REQUEST["par1"];
$par2= $_REQUEST["par2"];

      echo urlencode($par1 . "&" . "[fim]") . "<BR>" . urldecode(urlencode($par1 . "&" . "[fim]")) . "<BR>" . $par1 . "<BR>" . $par2 . "<BR>" . urlencode($par2) ;

?>