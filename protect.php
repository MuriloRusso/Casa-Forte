<?php

	if(!isset($_SESSION)){
		
		session_start();
		
	}

	if(!isset($_SESSION['id'])){
		
		//echo '<script>window.location.href="/anuncio/index.php";</script>';	
		
		header("Location: login.php");
		
		die("Você não está logado");
		//header("Location: index.php");
		
		
		
	}

?>