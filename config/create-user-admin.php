	<?php 

		include('../connect.php');

		$nome = $mysqli->real_escape_string($_POST['nome-completo']);

		$email = $mysqli->real_escape_string($_POST['email']);

		$senha = $mysqli->real_escape_string($_POST['senha']);

		$papel = $mysqli->real_escape_string($_POST['papel']);

		$genero = $mysqli->real_escape_string($_POST['genero']);

//		$cpf = $mysqli->real_escape_string($_POST['cpf']);

		$nascimento = $mysqli->real_escape_string($_POST['data-nascimento']);

		$telefone = $mysqli->real_escape_string($_POST['telefone']);



		$sql_code = "SELECT * FROM usuario";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

		$quantidade = $sql_query->num_rows;

		$emailUtilizado = false;


		if(!isset($_POST['id'])){
			
//			$sql_code = "SELECT * FROM usuario";
//
//			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
//
//			$quantidade = $sql_query->num_rows;
//
//			$emailUtilizado = false;

			if($quantidade > 0) {

				while($row = $sql_query->fetch_object()){

					if($row->email == $_POST['email']){

						$emailUtilizado = true;

					}	

				}

			}
			
			if($emailUtilizado === true){				
				
				header("Location: ../new-user-admin.php");
				
			}
			
			else{
				
				
				/*$foto = $_FILES['foto'];

				$pasta = "../img/products/";

				$nomeDoArquivo = $foto['name'];

				$novoNomeDoArquivo = uniqid();

				$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

				$path = $pasta . $novoNomeDoArquivo . "." . $extensao;


				$deu_certo = move_uploaded_file($foto["tmp_name"], $path);
	*/

				$sql_code = "INSERT INTO usuario (nome, email, senha, papel, genero, data_nascimento, telefone) VALUES ('{$nome}', '{$email}', '{$senha}', '{$papel}', '{$genero}',  '{$nascimento}', '{$telefone}')";

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

				header("Location: ../panel-users.php");
				
				
			}
			


		}

		else{
			
			if($quantidade > 0) {

				while($row = $sql_query->fetch_object()){

					if($row->email == $_POST['email']){

						$emailUtilizado = true;

					}	

				}

			}
			
			if($emailUtilizado === true){				
				
				header("Location: ../new-user-admin.php");
				
			}
			
			else{

				$id = $mysqli->real_escape_string($_POST['id']);

				$sql_code = "UPDATE usuario SET nome='{$nome}', descricao='{$descricao}', preco='{$preco}', NumeroParcelas='{$parcelas}' WHERE id=".$id;

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

				$foto = $_FILES['foto'];

				/*if($foto['name']){				

					$pasta = "../img/products/";

					$nomeDoArquivo = $foto['name'];

					$novoNomeDoArquivo = uniqid();

					$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

					$path = $pasta . $novoNomeDoArquivo . "." . $extensao;


					$deu_certo = move_uploaded_file($foto["tmp_name"], $path);


					$sql_code = "UPDATE usuario SET arquivoOriginal='{$nomeDoArquivo}', arquivo='{$novoNomeDoArquivo}', extensao='.{$extensao}' WHERE id=".$id;

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


				}
				*/

				header("Location: ../index.php");	
				
			}


		}



	?>