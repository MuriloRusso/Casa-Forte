<?php 

	include('../connect.php');

	$id = $mysqli->real_escape_string($_POST['id']);

	$nome = $mysqli->real_escape_string($_POST['nome']);

	$numero = $mysqli->real_escape_string($_POST['numero']);

	$logradouro = $mysqli->real_escape_string($_POST['logradouro']);

	$bairro = $mysqli->real_escape_string($_POST['bairro']);

	$cidade = $mysqli->real_escape_string($_POST['cidade']);

	$pais = $mysqli->real_escape_string($_POST['pais']);

	$cep = $mysqli->real_escape_string($_POST['cep']);
	
	$referencia = $mysqli->real_escape_string($_POST['ponto_referencia']);


	$sql_code = "UPDATE endereco SET nome_endereco='{$nome}', logradouro='{$logradouro}', numero='{$numero}', bairro='{$bairro}', cidade='{$cidade}', pais='{$pais}', cep='{$cep}', ponto_referencia='{$referencia}' WHERE ID=".$id;

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../my-profile.php");


?>