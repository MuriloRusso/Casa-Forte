<?php

	if(!isset($_SESSION)){
		
		session_start();
		
	}

	if(!isset($_SESSION['id']) || ($_SESSION['papel'] != 'admin' && $_SESSION['papel'] != 'colaborador')){
		
		//echo '<script>window.location.href="/anuncio/index.php";</script>';	
		
//		if($_SESSION['papel'] != 'Admin'){			
			
			header("Location: index.php");

			die("Você não está logado");
			//header("Location: index.php");			
			
//		}						
		
	}

?>