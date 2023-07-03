<?php 

	include('../connect.php');

	$id = $mysqli->real_escape_string($_POST['id']);

	$nome = $mysqli->real_escape_string($_POST['nome']);

	$numero = $mysqli->real_escape_string($_POST['numero']);

	$codigo = $mysqli->real_escape_string($_POST['seguranca']);

	$nomeTitular = $mysqli->real_escape_string($_POST['titular']);

	$cpfTitular = $mysqli->real_escape_string($_POST['cpf']);

	$vencimento = $mysqli->real_escape_string($_POST['vencimento']);

	$bandeira = $mysqli->real_escape_string($_POST['bandeira']);


	$sql_code = "UPDATE metodosdepagamento SET numero_do_cartao='{$numero}', data_vencimento='{$vencimento}', codigo_seguranca='{$codigo}', nome_titular='{$nomeTitular}', cpf_titular='{$cpfTitular}', nome_do_cartao='{$nome}', bandeira_do_cartao='{$bandeira}' WHERE ID=".$id;

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../my-profile.php");


?>