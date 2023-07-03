<?php

	if(!isset($_SESSION)){
		
		session_start();
		
	}

	if(!isset($_SESSION['id']) || $_SESSION['papel'] != 'cliente'){
		
			header("Location: index.php");

			die("Você não está logado");
				
		
	}

?>