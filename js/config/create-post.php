<?php 

	include('../connect.php');

	$titulo = $mysqli->real_escape_string($_POST['nome']);

	$texto = $mysqli->real_escape_string($_POST['texto']);

	$data_envio = date('d/m/Y');

//	$hora_envio = date('H:i:s');


	if(!isset($_POST['id'])){			

		$foto = $_FILES['capa'];

		$pasta = "../img/posts/";

		$nomeDoArquivo = $foto['name'];

		$novoNomeDoArquivo = uniqid();

		$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

		$path = $pasta . $novoNomeDoArquivo . "." . $extensao;

		$deu_certo = move_uploaded_file($foto["tmp_name"], $path);



		$sql_code = "INSERT INTO posts (titulo, texto, data_post, arquivoOriginal, arquivo, extensao) VALUES ('{$titulo}', '{$texto}', '{$$data_envio}', '{$nomeDoArquivo}', '{$novoNomeDoArquivo}', '.{$extensao}')";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

		header("Location: ../blog.php");
		
	}

	else{
		
		$id = $mysqli->real_escape_string($_POST['id']);

		$sql_code = "UPDATE posts SET nome='{$nome}', texto='{$texto}' WHERE id=".$id;
						
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

			$foto = $_FILES['capa'];
			
			if($foto['name']){				
				
				$pasta = "../img/products/";

				$nomeDoArquivo = $foto['name'];

				$novoNomeDoArquivo = uniqid();

				$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

				$path = $pasta . $novoNomeDoArquivo . "." . $extensao;


				$deu_certo = move_uploaded_file($foto["tmp_name"], $path);
				
						
				$sql_code = "UPDATE posts SET arquivoOriginal='{$nomeDoArquivo}', arquivo='{$novoNomeDoArquivo}', extensao='.{$extensao}' WHERE id=".$id;

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
				
				
			}
			

			header("Location: ../blog.php");	
		
		
	}


?>