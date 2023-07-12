<!DOCTYPE html>

<html>

<head>


	<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />

	<?php
	
		include('../head.php')
	?>


</head>


<body>
		
	<?php 

		include('../connect.php');


		$id = $mysqli->real_escape_string($_POST['id']);

		$nome = $mysqli->real_escape_string($_POST['nome']);

		$nascimento = $mysqli->real_escape_string($_POST['data_nascimento']);

		$telefone = $mysqli->real_escape_string($_POST['telefone']);




		$cpf = $mysqli->real_escape_string($_POST['cpf']);


		$sql_code = "SELECT * FROM usuario";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

		$quantidade = $sql_query->num_rows;


		$cpfUtilizado = false;

		if($quantidade > 0) {

			while($user = $sql_query->fetch_object()){

				if($user->cpfcnpj == $_POST['cpf'] &&  $user->id != $id){

					$cpfUtilizado = true;

				}	

			}

		}

		if($cpfUtilizado === true){		 

			print '<p class="btn-delete btn">CPF já utilizado.</p>
			
			
			<script>setTimeout(function(){

				window.location.href = "../my-profile.php";


			}, 1000)</script>';

			// header("Location: new-user-admin.php");

		}

		else{

			$sql_code = "UPDATE usuario SET nome='{$nome}', data_nascimento='{$nascimento}', telefone='{$telefone}', cpfcnpj='{$cpf}' WHERE id=".$id;

			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

			$foto = $_FILES['avatar'];

			if($foto['name']){				
						
				$pasta = "../img/users/";

				$nomeDoArquivo = $foto['name'];

				$novoNomeDoArquivo = uniqid();

				$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

				$path = $pasta . $novoNomeDoArquivo . "." . $extensao;


				$deu_certo = move_uploaded_file($foto["tmp_name"], $path);
				
						
				$sql_code = "UPDATE usuario SET avatar='{$novoNomeDoArquivo}', extensao='{$extensao}' WHERE id=".$id;

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
				
				
			}
			

			header("Location: ../my-profile.php");

		}


	?>

</body>

</html>