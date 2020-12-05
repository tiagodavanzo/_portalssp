<?php	  

// Cria a sesso do admin
function GeraSessao($usuario)
{
	//Iniciando a sessão
	session_start();
	
	//Criando as variáveis para a sessão
	$_SESSION[Config::$uniqid] = array('id' => $usuario->id, 'email' => $usuario->email, 'grupo' => $usuario->grupo, 'senha' => $usuario->senha);
	
	//Redirecionando para a página principal
	header("Location: index.php");
}

// Destrói a sessão do admin
function DestroiSessao()
{
	//Iniciando a sessão
	session_start();
	
	//Destruindo as variáveis de sessão
	unset($_SESSION[Config::$uniqid]);
}

function Login($email, $senha)
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array('email' => $email, 'senha' => $senha));
	curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/login');
	$result = curl_exec($ch);
	curl_close($ch);
	$obj = json_decode($result);

	return $obj[0];
}