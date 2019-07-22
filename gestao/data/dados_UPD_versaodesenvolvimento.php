<?
ini_set('default_charset','iso-8859-1');

require_once( '../../cliente/mantisbt/library/phpmailer/class.phpmailer.php' );
include("conecta.php");


$txtmail = "";

for ($x = 0; $x <= 20; $x++) {

    $query  = "SELECT desenvolvimento,modulo,mantis_project_id from  modulo WHERE id = " . $x ;
    $result = mysql_query($query) or die("A consulta falhou : " . mysql_error() . "<BR>" . $query);

	$arr = mysql_fetch_assoc($result);
    if ( $arr["desenvolvimento"] <> $_POST["id".$x] && $_POST["id".$x] <> "" ) {
        $query1 = "UPDATE modulo SET desenvolvimento = '" . $_POST["id".$x] . "', data_desenvolvimento = CURRENT_TIMESTAMP WHERE id = " . $x ;
        $result1 = mysql_query($query1) or die("A consulta falhou : " . mysql_error() . "<BR>" . $query1);
	
  	    $url = "http://www.uniondata.com.br/gestao/data/dados_SEL_verversao.php?sis=" . $arr["mantis_project_id"] . "&mod=" . $arr["modulo"] . "&ver=" . $_POST["id".$x] . "&sai=2" ;
	 //	$url = "http://www.uniondata.com.br/gestao/data/dados_SEL_verversao.php?sis=3&mod=mcontas&ver=07.07.16&sai=2";
		$txtmail = file_get_contents( $url );
	 
	    $query2 = " SELECT realname, email from mantis.mantis_user_table where groupcod = 2 " ;
        $result2 = mysql_query($query2) or die("A consulta falhou : " . mysql_error() . "<BR>" . $query2);
		
        $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
        try {
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'email-smtp.us-west-2.amazonaws.com';     // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = 'AKIAIB57JLLLGJMZQ52Q';               // SMTP username
            $mail->Password = 'AvlKbNldkuBInXn5lt/A2ZH4QCUvJ/Bp6vo6NnLudw1I';                            // SMTP password
            $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                      // TCP port to connect to

            //Recipients
            $mail->setFrom('sistema@uniondata.com.br', 'Mantis');
  		
		    $mail->addAddress( "danielwilson@allwaresolucoes.com.br",  "Daniel");     // Add a recipient
		    while ($ar2 = mysql_fetch_assoc($result2)) {
			       $mail->addAddress( $ar2["email"],  $ar2["realname"]);     // Add a recipient
			}	   
				   
            $mail->isHTML(true);                                       // Set email format to HTML
            $mail->Subject = 'Nova Cesta - ' . $arr["modulo"] . ' : ' . $_POST["id".$x] ;
            $mail->Body    = $txtmail;
            $mail->AltBody = $txtmail;
            $mail->send();
            echo 'Message has been sent';
           } catch (Exception $e) { echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo; }
    }
    #echo $_POST["id".$x] . "<BR>"; 
} 

?>
<script>
 window.open('../UnionMnuVert.php?op=8',"_top");
</script>
