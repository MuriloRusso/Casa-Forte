<?php


	include('../connect.php');


	$id = $_POST['id'];

	$sql_code = "DELETE FROM endereco WHERE ID=".$id;

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	header("Location: ../my-profile.php");


?>