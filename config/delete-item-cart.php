<?php


	include('../connect.php');


	$id = $_GET['id'];

	$sql_code = "DELETE FROM carrinho WHERE id=".$id;

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../carrinho.php");


?>