<?php 

	include('../connect.php');

	$idCliente = $mysqli->real_escape_string($_POST['id_cliente']);

	// $idCliente = $_SESSION['id'];

	$idProduto = $mysqli->real_escape_string($_POST['id_produto']);

	$quantidade = intval($mysqli->real_escape_string($_POST['quantidade']));


	$sql_code = "INSERT INTO carrinho (ID_Produtos, ID_Cliente, quantidade) VALUES ('{$idProduto}', '{$idCliente}', '{$quantidade}')";

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../carrinho.php");


?>