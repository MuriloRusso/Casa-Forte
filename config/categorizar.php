<?php 

	include('../connect.php');

	$idCategoria = $mysqli->real_escape_string($_POST['id_categoria']);

	$idProduto = $mysqli->real_escape_string($_POST['id_produto']);


	$sql_code = "INSERT INTO categorizar ( ID_categoria, ID_produto) VALUES ( '{$idCategoria}', '{$idProduto}')";

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../products.php");


?>