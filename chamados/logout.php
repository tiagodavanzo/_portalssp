<?
ob_start();
require_once ("config.php");
//Iniciando a sessão
session_start();
//Destruindo as variáveis de sessão
unset($_SESSION[Config::$uniqid]);
//Redirecionando para a página de login
Header("Location: login.php");
?>