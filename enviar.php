<?php
date_default_timezone_set('America/Sao_Paulo');
 
require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('vendor/phpmailer/phpmailer/src/SMTP.php');
require_once('vendor/phpmailer/phpmailer/src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
if((isset($_POST['email']) && !empty(trim($_POST['email']))) && (isset($_POST['mensagem']) && !empty(trim($_POST['mensagem'])))) {
 
	$nome = !empty($_POST['nome']) ? $_POST['nome'] : 'Não informado';
    $email = !empty($_POST['email']) ? utf8_decode($_POST['email']) : 'Não informado';
	$telefone = $_POST['telefone'];
	$assunto = !empty($_POST['assunto']) ? utf8_decode($_POST['assunto']) : 'Não informado';
	$mensagem = $_POST['mensagem'];
	$ramal = $_POST['ramal'];
	$celular = $_POST['celular'];
	$data = date('d/m/Y H:i:s');
 
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'robattistoni@gmail.com';
	$mail->Password = 'Rogerbatt1!';
	$mail->Port = 587;
 
	$mail->setFrom('robattistoni@gmail.com');
	$mail->addAddress('robattistoni@gmail.com');
 
	$mail->isHTML(true);
	$mail->Subject = $assunto;
	$mail->Body = "<h2>Contato</h2><br>
	<h3>Nome:</h3> ${nome}<br>
	<h3>Telefone: </h3> ${telefone}      <h3>Ramal: </h3> ${ramal}<br>
	<h3>Celular: </h3> ${celular}<br>
	<h3>Mensagem: </h3> ${mensagem}<br>
	<h3>Data de envio: </h3> ${data}<br>
	";
 
	if($mail->send()) {
		echo '<h3>Email enviado com sucesso!</h3>';
	} else {
		echo 'Email não enviado.';
	}
} else {
	echo 'Não enviado: informar o email e a mensagem.';
}
header("Location: https://localhost/web/");