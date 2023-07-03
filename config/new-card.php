<?php 

	include('../connect.php');

	$idCliente = $mysqli->real_escape_string($_POST['id_cliente']);

	$nome = $mysqli->real_escape_string($_POST['nome']);

	$numero = $mysqli->real_escape_string($_POST['numero']);

	$codigo = $mysqli->real_escape_string($_POST['seguranca']);

	$nomeTitular = $mysqli->real_escape_string($_POST['nome-titular']);

	$cpfTitular = $mysqli->real_escape_string($_POST['cpf-titular']);

	$vencimento = $mysqli->real_escape_string($_POST['vencimento']);

	$bandeira = $mysqli->real_escape_string($_POST['bandeira-cartao']);


	$sql_code = "INSERT INTO metodosdepagamento (numero_do_cartao, data_vencimento, codigo_seguranca, nome_titular, cpf_titular, ID_Cliente, nome_do_cartao, bandeira_do_cartao) VALUES ('{$numero}', '{$vencimento}', '{$codigo}', '{$nomeTitular}', '{$cpfTitular}', '{$idCliente}', '{$nome}',  '{$bandeira}')";

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../my-profile.php");


?>