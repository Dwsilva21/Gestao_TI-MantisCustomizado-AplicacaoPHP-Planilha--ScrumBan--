<?php
require_once( '../cliente/mantisbt/library/phpmailer/class.phpmailer.php' );
include('graf_linha.php');

$mail = new PHPMailer(true);                                // Passing `true` enables exceptions
try {
    //Server settings
   // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host = 'email-smtp.us-west-2.amazonaws.com';     // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->Username = 'AKIAIB57JLLLGJMZQ52Q';               // SMTP username
    $mail->Password = 'AvlKbNldkuBInXn5lt/A2ZH4QCUvJ/Bp6vo6NnLudw1I';                            // SMTP password
    $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                      // TCP port to connect to

    //Recipients
    $mail->setFrom('sistema@uniondata.com.br', 'Mantis');
  //  $mail->addAddress('uniondata_todos@uniondata.com.br', 'Daniel Wilson');     // Add a recipient
    $mail->addAddress('daniel.wilson@uniondata.com.br', 'Daniel Wilson');     // Add a recipient
    $mail->addAddress('vera.garcia@uniondata.com.br', 'Vera Garcia');         // Add a recipient
    $mail->addAddress('alexandre@uniondata.com.br', 'Alexandre');             // Add a recipient
	
    //$mail->addAddress('ellen@example.com');                                 // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

	$encode = $plot->EncodeImage('raw');
	$tmpfname = 'grafico.png' ;
	$uploadfile = tempnam(sys_get_temp_dir(), $tmpfname );
	$handle = fopen($uploadfile, "w");
	
    fwrite($handle, $encode );
    fclose($handle);
	//1234567890123456789012
	//data:image/png;base64, 
	
    //Attachments
     // $mail->addAttachment('image/img_avatar4.png');         // Add attachments
     // $mail->addAttachment( $plot->EncodeImage() );     
        $mail->addAttachment($uploadfile, $tmpfname );
    //Content
    $mail->isHTML(true);                                       // Set email format to HTML
    $mail->Subject = 'Chamados - Abertos x Resolvidos';
    $mail->Body    = '<font face=Arial>Gr&aacute;fico comparativo di&aacute;rio<br><br><b><u>Esta &eacute; uma mensagem autom&aacute;tica. Por favor, n&atilde;o responda este e-mail</b></u>';
	


    $mail->AltBody = 'Gr&aacute;fico comparativo di&aacute;rio';

    $mail->send();
    echo 'Message has been sent';
	//echo $encode;
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}