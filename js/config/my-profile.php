<?php 

	include('../connect.php');

	$id = $mysqli->real_escape_string($_POST['id']);

	$nome = $mysqli->real_escape_string($_POST['nome']);

	$nascimento = $mysqli->real_escape_string($_POST['data_nascimento']);

	$telefone = $mysqli->real_escape_string($_POST['telefone']);

	$sql_code = "UPDATE usuario SET nome='{$nome}', data_nascimento='{$nascimento}', telefone='{$telefone}' WHERE id=".$id;

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../my-profile.php");


?>