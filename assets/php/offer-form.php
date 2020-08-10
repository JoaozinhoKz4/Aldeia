<?php
	session_start();
	$titulo= $_SESSION['var_titulo'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$tipo_contato = $_POST['tipo-contato'];
	$emailTo = 'aldeia@imobiliariaaldeia.com.br'; //Put your own email address here
	$oferta = $_POST['oferta'];
	$body = "Nome: $name \n\nEmail: $email \n\nTelefone: $phone \n\nContato para:$tipo_contato $titulo \n\nConteúdo do email:$oferta";
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	$headers = 'From: '.$email."\r\n" .
		'Reply-To: '.$email."\r\n";
	var_dump($body);
	mail($emailTo, $tipo_contato, $body, $headers);
	$emailSent = true;
	echo ('success');
	
?>
