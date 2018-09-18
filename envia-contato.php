<?php 

session_start();

require_once("PHPMailerAutoload.php");
require_once("class.pop3.php");
require_once("class.smtp.php");
require_once("class.phpmailer.php");

$email = $_POST['email'];
$nome = $_POST['nome'];
$mensagem = $_POST['mensagem'];

$mail = new PHPMailer();
$mail->isSMTP();
$main->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "andremysql@gmail.com";
$mail->Password = "mysql123";

$mail->setFrom("andremysql@gmail.com", "Minha loja");
$mail->addAddress("andre.bonfante@universo.univates.br");
$mail->Subject = 'Contato - Minha loja';
$mail->msgHTML("<html>De: {$nome} <br> Email: {$email} <br> Mensagem: {$mensagem} <br> </html>");
$mail->AltBody = "De: {$nome}\n Email: {$email}\n Mensagem: {$mensagem}";


if ($mail->send()) {
	$_SESSION['success'] = "Email enviado com sucesso!";
	header("Location: index.php");
} else {
	$_SESSION['danger'] = "Problema ao enviar email: " . $mail->ErrorInfo;
	header("Location: contato.php");
}

die();