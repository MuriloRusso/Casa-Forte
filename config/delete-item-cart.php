<?php


	include('../connect.php');


	$id = $_GET['id'];

	$sql_code = "SELECT * FROM carrinho WHERE id=".$id;

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	$carrinho = $sql_query->fetch_object();  

	$idCliente = $carrinho->ID_Cliente;

	print $idCliente . '<br>';

	$sql_codeUser = "SELECT * FROM usuario WHERE id=".$idCliente;

	$sql_query = $mysqli->query($sql_codeUser) or die("Falha na execução do código SQL" . $mysqli->error);

	$user = $sql_query->fetch_object();  


	if($idCliente == $user->id){

		$sql_code2 = "DELETE FROM carrinho WHERE id=".$id;

		$sql_query = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);


		header("Location: ../carrinho.php");


	}

	else{

		print 'Você não tem permissão para acessar esse link!';

	}



?>