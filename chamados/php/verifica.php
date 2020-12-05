<?php
session_start();
//Verificando a existência da sessão
if(!(isset($_SESSION[Config::$uniqid]) && isset($_SESSION[Config::$uniqid]["id"]) && isset($_SESSION[Config::$uniqid]["email"]) && isset($_SESSION[Config::$uniqid]["grupo"]) && isset($_SESSION[Config::$uniqid]["senha"])))
	Header("Location: login.php");

?>