	<?php 

		include('../connect.php');

		$nome = $mysqli->real_escape_string($_POST['nome']);

		$descricao = $mysqli->real_escape_string($_POST['descricao']);

		$preco = $mysqli->real_escape_string($_POST['preco']);

		$parcelas = $mysqli->real_escape_string($_POST['parcelas']);






		if(!isset($_POST['id'])){			
			
			$foto = $_FILES['foto'];

			$pasta = "../img/products/";

			$nomeDoArquivo = $foto['name'];

			$novoNomeDoArquivo = uniqid();

			$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

			$path = $pasta . $novoNomeDoArquivo . "." . $extensao;

			
			$deu_certo = move_uploaded_file($foto["tmp_name"], $path);

					
			$sql_code = "INSERT INTO produtos (nome, descricao, arquivoOriginal, arquivo, extensao, preco, NumeroParcelas) VALUES ('{$nome}', '{$descricao}', '{$nomeDoArquivo}', '{$novoNomeDoArquivo}', '.{$extensao}', '{$preco}', '{$parcelas}')";
						
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

			header("Location: ../products.php");


		}

		else{
			
			$id = $mysqli->real_escape_string($_POST['id']);
					
			$sql_code = "UPDATE produtos SET nome='{$nome}', descricao='{$descricao}', preco='{$preco}', NumeroParcelas='{$parcelas}' WHERE id=".$id;
						
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

			$foto = $_FILES['foto'];
			
			if($foto['name']){				
				
				$pasta = "../img/products/";

				$nomeDoArquivo = $foto['name'];

				$novoNomeDoArquivo = uniqid();

				$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

				$path = $pasta . $novoNomeDoArquivo . "." . $extensao;


				$deu_certo = move_uploaded_file($foto["tmp_name"], $path);
				
						
				$sql_code = "UPDATE produtos SET arquivoOriginal='{$nomeDoArquivo}', arquivo='{$novoNomeDoArquivo}', extensao='.{$extensao}' WHERE id=".$id;

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
				
				
			}
			

			header("Location: ../products.php");			


		}



	?>