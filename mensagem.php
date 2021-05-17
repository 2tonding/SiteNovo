<?php
session_start();
include_once "databaseconnect.php";

$login = $_SESSION['login'];
$nomenenvia = $_POST['nomeE'];      //id do remetente
$iddestinatario = $_POST['nomeR'];            //id do destinatario
$mensagem = $_POST['mensagem'];

$sql = "INSERT INTO conversa (id, remetente, destinatario, mensagem, data_envio) VALUES ('$nomenenvia', '$nomenenvia','$iddestinatario','$mensagem', now())";

//====================================
//funcao de envio de email
//====================================
//dados do enviador
$sqlenvia = "select * from users where login = '$loginsessao'";
$listagem = $conn->query($sqlenvia);
while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
	$nome = $lista['nome'];
	$login = $lista['login'];
	$profissao = $lista['profissao'];
	$cidade = $lista['cidade'];
	$estado = $lista['estado'];
    $id = $lista['id'];
}
//dados do recebedor
$sqlrecebe = "select nome, login from users where id = '$iddestinatario'";
$listagem2 = $conn->query($sqlrecebe);
while ($lista2 = $listagem2->fetch(PDO::FETCH_ASSOC)){
	$nomeemail = $lista2['nome'];
	$to = $lista2['login'];
}
// montando o email
require 'PHPMailer/PHPMailerAutoload.php';
$host = "desenvolvimentohonnest.com.br";
$port = "465";
$username = "contato@desenvolvimentohonnest.com.br";
$password = "ecr+b%5@c?2";

$mail = new PHPMailer(true);
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
    $mail->SetFrom('contato@desenvolvimentohonnest.com.br', '[RED] - Representante Distribuidor');
    $mail->addAddress($to);     // Add a recipient
    $mail->addReplyTo($login, $nome);
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = '[RED] Você recebeu uma nova proposta';
    $mail->Body    = '
	<p>===========================================</p>
	<p>======VOCÊ RECEBEU UMA MENSAGEM============</p>
	<p>===========================================</p>
	<p>NOME DO INTERESSADO: </p>
	'.$nome.'
	<p>EMAIL DO INTERESSADO: </p>
	'.$login.'
	<p>PROFISSÃO: </p>
	'.$profissao.'
	<p>Local da oferta: </p>
	'.$cidade.' - '.$estado.'
	<p>MENSAGEM: </p>
	'.$mensagem.'

    <p>Se preferir, acesse o link do profissional no RED:
	<a href="http://marciof4.sg-host.com/perfil.php?id='.$id.'">Clicando aqui</a></p>
	';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    $mail->send();

//====================================
//final da funcao de envio de email
//====================================

$insert = $conn->query($sql);
if($insert){
          $_SESSION['login'] = $login;
          echo"<script language='javascript' type='text/javascript'>
                alert('Mensagem enviada com sucesso');
                window.location.href='painel.php'
		  		</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível enviar a mensagem');
          </script>";
        }
?>