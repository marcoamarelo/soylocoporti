
<?php
	error_reporting(E_NOTICE);

	function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	if($_POST['first_name']!='' && $_POST['e_mail']!='' && valid_email($_POST['e_mail'])==TRUE && strlen($_POST['message'])>30)
	{
		
		//recebendo o email do admin do wp
		$to = $_POST['admin_email'];
		
		$headers = 	'From: '.$_POST['e_mail'].''. "\r\n" .
				'Reply-To: '.$_POST['e_mail'].'' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		$subject = "Site Getz - Formulário de contato";
		$message = htmlspecialchars($_POST['message']);
		
		if(mail($to, $subject, $message, $headers))
		{//we show the good guy only in one case and the bad one for the rest.
			echo 'Obrigado, '.$_POST['first_name'].'. Sua mensagem foi enviada.';
		}
		else {
			echo "Mensagem não enviada. Por favor, confira se você não está
				rodando este formulário localmente e também se você tem permissão 
				para executar a função mail() em seu servidor.";
		}
	}
	else {
		echo 'Ocorreu um erro. Por favor, confira se você preencheu todos os campos, se você 
		inseriu um e-mail válido e se a sua mensagem contém mais de 30 caracteres.';
	}
?> 

