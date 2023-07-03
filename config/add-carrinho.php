<?php 

	include('../connect.php');

	$idCliente = $mysqli->real_escape_string($_POST['id_cliente']);

	// $idCliente = $_SESSION['id'];

	$idProduto = $mysqli->real_escape_string($_POST['id_produto']);


	$sql_code = "INSERT INTO carrinho (ID_Produtos, ID_Cliente) VALUES ('{$idProduto}', '{$idCliente}')";

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../carrinho.php");


?>