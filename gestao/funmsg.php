<?php
require_once( '../cliente/mantisbt/library/phpmailer/class.phpmailer.php' );

function enviaMSG( $from, $to, $subject, $body, $altbody = '',  $file = '' )
{
   $msg = "";
   $mail = new PHPMailer(true);                             // Passing `true` enables exceptions
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
    $mail->setFrom('suporte@uniondata.com.br', $from);
//    $mail->setFrom($from , "Daniel Wilson");

    for($i=0;$i<count($to);$i++) 
	{  $mail->addAddress($to[$i]);  }   


	if ( $file != "" ) { $mail->addAttachment( $file ); }
    $mail->isHTML(true);                                       // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    if ( $altbody != "" ) { $mail->AltBody = $altbody; }
    $mail->send();
    $msg = "Message has been sent";
   } catch (Exception $e) { 
     $msg .= "from: " . $from . "<BR>";
	 
    for($i=0;$i<count($to);$i++) 
	{	
     $msg .= "to: " . $to[$i] . "<BR>";
	}   
     $msg .= "to: " . count($to) . "<BR>";
     $msg .= "subject: " . $subject. "<BR>";
     $msg .= "body: " . $body. "<BR>";
     $msg .= "altbody: " . $altbody. "<BR>";
     $msg .= "dir: " . $dir. "<BR>";
     $msg .= "file: " . $file. "<BR>";
     $msg .= "Message could not be sent. Mailer Error: " . $mail->ErrorInfo; 
  }
   
   return $msg ;
}
?>

