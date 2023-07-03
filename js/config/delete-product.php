<?php


	include('../connect.php');


	$id = $_POST['id'];

	$sql_code = "DELETE FROM produtos WHERE id=".$id;

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../products.php");


?>