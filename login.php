<?php
session_start();
include('conecta.php');

if(empty($_POST['email']) || empty($_POST['senha'])) { /*Não permite uqe o usuario acesse o sistema sem preencher os campos*/
	header('Location: login.html');
	exit();
}

$email = mysqli_real_escape_string($conn, $_POST['email']);/*prevenção contra ataques de sql injection*/
$senha = mysqli_real_escape_string($conn, $_POST['senha']);/*prevenção contra ataques de sql injection*/

$query = "select email from `tb_admin` where email = '{$email}' and senha = '{$senha}'";

$result = mysqli_query($conn, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['email'] = $email;
	header('Location:admin_lollita.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	echo"
	<link rel='stylesheet' href='estilo_tela_ent.css'>
	<div class='erro_nao_autenticado'>
		<i class='fas fa-exclamation-triangle'></i>
		<h2>Informe corretamente o E-mail e a Senha.</h2>
		<a href=login.html class='link_return'>Retornar a tela de login</a>
	<div>
	<script src='https://kit.fontawesome.com/6bb7bca18b.js' crossorigin='anonymous'></script>
	";
	exit();
}
?>
