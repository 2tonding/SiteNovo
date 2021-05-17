<?php
require 'PHPMailer/PHPMailerAutoload.php';
// require 'PHPMailer/Exception.php';
// require 'PHPMailer/class.phpmailer.php';
// require 'PHPMailer/class.smtp.php';

$from_email = $_POST['from'];
$from_name = $_POST['name'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$to = $_POST['to'];

$host = "desenvolvimentohonnest.com.br";
$port = "465";
$username = "contato@desenvolvimentohonnest.com.br";
$password = "ecr+b%5@c?2";


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $host;                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $port;                                    // TCP port to connect to

    //Recipients
    $mail->SetFrom($from_email, $from_name);
    $mail->addAddress('2tonding@gmail.com', 'Joe User');     // Add a recipient
    // $mail->addAddress($to);
    // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('2tonding@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>
	<div>
						<?php 
						echo $from_name;
						echo $content;
						?>
						teste depois do php
    </div>
    testando a concatenacao '.$from_name.' '.$from_email.'';

	;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';

?>