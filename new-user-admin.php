<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect-adm.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="new-product">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');
			
				$user;
			
				$id;
			
				$nome;
			
				$email;
			
				$senha;
			
				$papel;
			
				$genero;
			
				$nascimento;
			
				$telefone;
			
			
				
			
				 if(isset($_GET['id'])){

					 $id = $_GET['id'];
					 

					$sql_code = "SELECT * FROM usuario WHERE id='".$id."'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					 
					$user = $sql_query->fetch_object();				
					 
//					$id =  $user->id;
			
					$nome = $user->nome;

					$email = $user->email;

					$senha = $user->senha;

					$papel = $user->papel;

					$genero = $user->genero;

					$nascimento = $user->data_nascimento;

					$telefone = $user->telefone;


				 }

			
			
			?>
			
	
			
			
			<section>

				<form method="post" action=""  enctype="multipart/form-data">
						
						
					<?php 

					
				// 		$nome = '';

				// 		$email = '';

				// 		$senha = '';

				// 		$papel = '';

				// 		$genero = '';

				// //		$cpf = $mysqli->real_escape_string($_POST['cpf']);

				// 		$nascimento = '';

				// 		$telefone = '';	

						$sql_code = "SELECT * FROM usuario";

						$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

						$quantidade = $sql_query->num_rows;

						$emailUtilizado = false;

//							$user;

						if(!isset($_POST['id'])){

							if($_POST['email'] != ''){

								$nome = $mysqli->real_escape_string($_POST['nome-completo']);

								$email = $mysqli->real_escape_string($_POST['email']);

								$senha = $mysqli->real_escape_string($_POST['senha']);

								$papel = $mysqli->real_escape_string($_POST['papel']);

								$genero = $mysqli->real_escape_string($_POST['genero']);

						//		$cpf = $mysqli->real_escape_string($_POST['cpf']);

								$nascimento = $mysqli->real_escape_string($_POST['data-nascimento']);

								$telefone = $mysqli->real_escape_string($_POST['telefone']);	

								if($quantidade > 0) {

									while($user = $sql_query->fetch_object()){

										if($user->email == $_POST['email']){

											$emailUtilizado = true;

										}	

									}

								}

								if($emailUtilizado === true){		 

									print '<p class="btn-delete btn">E-mail já utilizado.</p>';

									// header("Location: new-user-admin.php");

								}

								else{



									$sql_code = "INSERT INTO usuario (nome, email, senha, papel, genero, data_nascimento, telefone) VALUES ('{$nome}', '{$email}', '{$senha}', '{$papel}', '{$genero}',  '{$nascimento}', '{$telefone}')";

									$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

									header("Location: panel-users.php");


								}


							}



						}

						else{

							if(isset($_POST['email'])){
								
								$nome = $mysqli->real_escape_string($_POST['nome-completo']);

								$email = $mysqli->real_escape_string($_POST['email']);

								$senha = $mysqli->real_escape_string($_POST['senha']);

								$papel = $mysqli->real_escape_string($_POST['papel']);

								$genero = $mysqli->real_escape_string($_POST['genero']);

						//		$cpf = $mysqli->real_escape_string($_POST['cpf']);

								$nascimento = $mysqli->real_escape_string($_POST['data-nascimento']);

								$telefone = $mysqli->real_escape_string($_POST['telefone']);	
							
								if($quantidade > 0) {

									while($user = $sql_query->fetch_object()){

										if($user->email == $_POST['email']){

											$emailUtilizado = true;

										}	

									}

								}

								if($emailUtilizado === true){		

									print '<p class="btn-delete btn">E-mail já utilizado.</p>';

									// header("Location: new-user-admin.php");

								}

								else{

	//									$id = $mysqli->real_escape_string($_POST['id']);

									$sql_code = "UPDATE usuario SET nome='{$nome}', email='{$email}', senha='{$senha}', papel='{$papel}', genero='{$genero}', data_nascimento='{$nascimento}', telefone='{$telefone}' WHERE id=".$id;

									$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	//									$foto = $_FILES['foto'];

									header("Location: panel-users.php");	

								}
								
							}


						}



					?>



					<div class="form-group">
						
						<h2>Novo Usuário</h2>
						
					</div>
						
						
					 <?php 

						if(isset($_GET['id'])){
							
							print '<input type="hidden" name="id" value="'.$id.'" required>';
							
						}						
						
						
					?>

					
						
					<div class="form-group">

						<label for="nome-completo">Nome Completo:</label>
						<input type="text" id="nome-completo" name="nome-completo" value="<?php echo $nome; ?>" required placeholder="Digite o nome completo do usuário aqui">

					</div>
					
					
					 <div class="form-group">

						<label for="email">E-mail:</label>
						<input type="text" id="email" name="email" value="<?php echo $email; ?>" required placeholder="Digite o e-mail do usuário aqui"> 

					</div>
						
						
					 <div class="form-group">

						<label for="senha">Senha:</label>
						<input type="password" id="senha" name="senha" value="<?php echo $senha; ?>" required placeholder="Digite a senha do usuário aqui">

					</div>
						
					<div class="form-group">

						<label for="papel">Papel:</label>
						
						<select id="papel" name="papel" required data-value="<?php echo $papel; ?>"> 
						
							<option value="cliente" selected>Cliente</option>
							<option value="admin">Admin</option>

						
						</select>

					</div>
		

					<div class="form-group-radio" id="generoContainer" data-value="<?php echo $genero; ?>">

						<label for="genero">Gênero:</label>
						
						<div>
						
						
							<input type="radio" name="genero" value="masculino" id="masculino"> 
							<label for="masculino">Masculino</label>
						
						
						</div>
						
						<div>
						
							<input type="radio" name="genero" value="feminino" id="feminino"> 
							<label for="feminino">Feminino</label>
						
						</div>
						
						
						<div>
						
							<input type="radio" name="genero" value="outro" id="outro" checked> 
							<label for="outro">Outro</label>
						
						</div>						

					</div>
						

					<!-- <div class="form-group">

						<label for="cpf">CPF:</label>
						<input type="text" id="cpf" name="cpf" required onkeypress="$(this).mask('000.000.000-00')" value="<?php echo $cpf; ?>" placeholder="999.999.999-99">

					</div> -->

					 <div class="form-group">

						<label for="data-nascimento">Data de Nascimento:</label>
						<input type="date" id="data-nascimento" name="data-nascimento" value="<?php echo $nascimento; ?>" required>

					</div>
					
					

					<div class="form-group">

						<label for="telefone">Telefone:</label>
						<input type="text" id="telefone" name="telefone" required onkeypress="$(this).mask('(99) 99999-9999')" value="<?php echo $telefone; ?>" placeholder="(99) 99999-9999">

					</div>



					<div class="form-submit-group flex flex-wrap justify-content-space-betwen">
						
						<?php 

							if(isset($_GET['id'])){

								print '<input class="btn-primary" type="submit" id="submit" value="Atualizar Usuário">';

							}				
						
							else{
								
								print '<input class="btn-primary" type="submit" id="submit" value="Criar Novo Usuário">';
								
							}
						


						?>


					</div>


				</form>


			</section>





            <!-- <section>

            <?php 

                include('blocks/posts.php');

            ?>

            </section> -->
			
			<?php 

				include('footer.php');

			?>





        </div>
        
		<script>

			const generoAtual = document.querySelector('#generoContainer').getAttribute('data-value');

			document.querySelector(`#generoContainer input[value=${generoAtual}]`).checked = true;


		</script>

		<script>

		const papelAtual = document.querySelector('#papel').getAttribute('data-value');

		document.querySelector(`#papel option[value=${papelAtual}]`).selected = true;


		</script>


    </body>



</html>
