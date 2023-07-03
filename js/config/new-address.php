<?php 

	include('../connect.php');

	$idCliente = $mysqli->real_escape_string($_POST['id_cliente']);

	$nome = $mysqli->real_escape_string($_POST['nome']);

	$numero = $mysqli->real_escape_string($_POST['numero']);

	$logradouro = $mysqli->real_escape_string($_POST['logradouro']);

	$bairro = $mysqli->real_escape_string($_POST['bairro']);

	$cidade = $mysqli->real_escape_string($_POST['cidade']);

	$pais = $mysqli->real_escape_string($_POST['pais']);

	$cep = $mysqli->real_escape_string($_POST['cep']);
	
	$referencia = $mysqli->real_escape_string($_POST['ponto-referencia']);


	$sql_code = "INSERT INTO endereco (nome_endereco, logradouro, numero, bairro, cidade, pais, cep, ponto_referencia, ID_Cliente) VALUES ('{$nome}', '{$logradouro}', '{$numero}', '{$bairro}', '{$cidade}', '{$pais}', '{$cep}', '{$referencia}', '{$idCliente}')";

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../my-profile.php");


?>