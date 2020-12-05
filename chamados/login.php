<?
	ob_start();
	require_once ("config.php");
	
	DestroiSessao();

	if(isset($_POST['btnOK']))
	{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('email' => $_POST["inputEmail"], 'senha' => $_POST["inputPassword"]));
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/login');
    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result);

    $usuario = $obj[0];
    
    if(isset($usuario->id))
			GeraSessao($usuario);
		else
      echo "<script>alert('Usuário e/ou senha incorretos. Tente novamente.');</script>";    
	}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Sistema de Chamados - Portal SSP</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" method="post">
      <img class="mb-4" src="img/logo.png" alt="">
      <h1 class="h3 mb-3 font-weight-normal">Sistema de Chamados</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Senha" required>
      <button class="btn btn-lg btn-primary btn-block" id="btnOK" name="btnOK" type="submit">Login</button>
  </form>
</body>
</html>
