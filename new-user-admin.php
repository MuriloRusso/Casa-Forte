<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');


		 include('protect-colaborador.php');


		//  if($_SESSION['papel'] == 'colaborador'){

		// 	include('protect-colaborador.php');


		//  }

		//  else{

		// 	include('protect-adm.php');

		//  }

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

				$cpf;
			
				$email;
			
				$senha;
			
				$papel;
			
				$genero;
			
				$nascimento;
			
				$telefone;

				$cep;

				$logradouro;

				$numero;

				$bairro;

				$cidade;

				$pais;

				$referencia;

				$avatar = '';
			
				$extensao = '';
			
				
			
				 if(isset($_GET['id'])){

					$id = $_GET['id'];					 

					$sql_code = "SELECT * FROM usuario WHERE id='".$id."'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					 
					$user = $sql_query->fetch_object();				
					 
//					$id =  $user->id;
			
					$nome = $user->nome;

					$cpf = $user->cpfcnpj;

					$email = $user->email;

					$senha = $user->senha;

					// print "senha: ".$senha;

					$papel = $user->papel;

					$genero = $user->genero;

					$nascimento = $user->data_nascimento;

					$telefone = $user->telefone;

					$avatar = $user->avatar;

					$extensao = $user->extensao;

					$cep = $user->cep;

					$logradouro = $user->rua;

					$numero = $user->numero;

					$bairro = $user->bairro;

					$cidade = $user->cidade;

					$pais = $user->pais;

					$referencia = $user->complemento;



					if($_SESSION['papel'] == 'colaborador' && $papel != 'cliente'){

						include('protect-adm.php');


					}


				 }

			
			
			?>
			
	
			
			
			<section>

				<form method="post" action=""  enctype="multipart/form-data" class="form-model">
						
						
					<?php 

						use PHPMailer\PHPMailer\PHPMailer;
						use PHPMailer\PHPMailer\Exception;

						require 'PHPMailer-master-atual/PHPMailer-master/src/Exception.php';
						require 'PHPMailer-master-atual/PHPMailer-master/src/PHPMailer.php';
						require 'PHPMailer-master-atual/PHPMailer-master/src/SMTP.php';

						$sql_code = "SELECT * FROM usuario";

						$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

						$quantidade = $sql_query->num_rows;

						$emailUtilizado = false;

						$cpfUtilizado = false;

//							$user;

						if(!isset($_POST['id'])){

							$senha = $mysqli->real_escape_string($_POST['senha']);

							if(strlen($senha) > 5 ){

								if($_POST['email'] != ''){

									$nome = $mysqli->real_escape_string($_POST['nome-completo']);

									$cpf = $mysqli->real_escape_string($_POST['cpf']);

									$email = $mysqli->real_escape_string($_POST['email']);

									$hash = $senha;

									// $hash = password_hash($senha, PASSWORD_BCRYPT);


									$papel = $mysqli->real_escape_string($_POST['papel']);

									$genero = $mysqli->real_escape_string($_POST['genero']);

							//		$cpf = $mysqli->real_escape_string($_POST['cpf']);

									$nascimento = $mysqli->real_escape_string($_POST['data-nascimento']);

									$telefone = $mysqli->real_escape_string($_POST['telefone']);	


									$cep =  $mysqli->real_escape_string($_POST['cep']);

									$logradouro =  $mysqli->real_escape_string($_POST['logradouro']);

									$numero =  $mysqli->real_escape_string($_POST['numero']);

									$bairro =  $mysqli->real_escape_string($_POST['bairro']);

									$cidade =  $mysqli->real_escape_string($_POST['cidade']);

									$pais =  $mysqli->real_escape_string($_POST['pais']);

									$referencia =  $mysqli->real_escape_string($_POST['ponto-referencia']);

									if($quantidade > 0) {

										while($user = $sql_query->fetch_object()){

											if($user->email == $_POST['email']){

												$emailUtilizado = true;

											}	

											if($user->cpfcnpj == $_POST['cpf']){

												$cpfUtilizado = true;
				
											}	

										}

									}

									if($emailUtilizado === true){		 

										print '<p class="btn-delete btn">E-mail já utilizado.</p>';

										// header("Location: new-user-admin.php");

									}

									else if($cpfUtilizado === true){		 

										print '<p class="btn-delete btn">CPF já utilizado.</p>';

										// header("Location: new-user-admin.php");

									}

									else{

										$avatar = $_FILES['avatar'];

										$novoNomeDoArquivo = '';

										if($avatar['name']){				
													
											$pasta = "img/users/";

											$nomeDoArquivo = $avatar['name'];

											$novoNomeDoArquivo = uniqid();

											$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

											$path = $pasta . $novoNomeDoArquivo . "." . $extensao;


											$deu_certo = move_uploaded_file($avatar["tmp_name"], $path);
																			
										}

										$sql_code = "INSERT INTO usuario (nome, cpfcnpj, email, senha, papel, genero, data_nascimento, telefone, avatar, extensao, cep, rua, numero, bairro, cidade, pais, complemento) VALUES ('{$nome}', '{$cpf}', '{$email}', '{$hash}', '{$papel}', '{$genero}',  '{$nascimento}', '{$telefone}', '{$novoNomeDoArquivo}', '{$extensao}', '{$cep}', '{$logradouro}', '{$numero}', '{$bairro}', '{$cidade}', '{$pais}', '{$referencia}')";

										$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);



										$mail = new PHPMailer();
										$mail->isSMTP();
				
				
										$mail->Host = 'smtp.hostinger.com';
										$mail->SMTPAuth = true;
										$mail->SMTPSecure = "tls";
										$mail->Port = "587";
										$mail->Username = 'no-reply@vertconclube.com.br';
										$mail->Password = 'Senti@nela2021';
				
										$mail->setFrom('no-reply@vertconclube.com.br', 'vertconclube');
				
										$mail->addReplyTo('no-reply@vertconclube.com.br', 'vertconclube');
				
										// include('config/smtp.php');
				
				
				
										// $mail->addAddress('no-reply@vertconclube.com.br', 'vertconclube');
				
										$mail->addAddress($email, 'vertconclube');
				
				
										// $mail->addCC('contato@murilorusso.com.br', 'SLMIT');
				
										// $mail->addBCC('murilorussooo@gmail.com', 'SLMIT');	
											
										$mail->Subject = 'Sua conta foi Registrada com Sucesso!';
				
										$mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';
				
				
										$mail->isHTML(true);
				
				
									
										$mailContent = " 
										
										Olá: $nome <br>
				
										Foi Criada uma conta com seu e-mail em nossa Loja pela administração<br>
				
										Acesse o link abaixo para se Logar: <br>
										
										http://casaforteprojetoseservicos.com.br/novo/login.php 
				
								
										
										";
									
										$mailContent = utf8_decode($mailContent);
				
										$mail->Body = $mailContent;
				
				
										$mail->send();
				
										// if($mail->send()){
				
										//     print '<p class="alert-sucess text-center">Solicitação Enviada Com Sucesso</p>';
				
										// }
										
										// else{
				
										//     print '<p class="btn-delete btn">'.$mail->ErrorInfo.'</p>';
				
										// }





										// header("Location: panel-users.php");

										print '<script>    
										
										window.location.href = "panel-users.php";

										</script>';



									}


								}

							}

							else{

								if($senha != ''){

									print '<div class="btn btn-delete">A senha deve conter no mínimo 6 caracteres2!</div>';

								}


							}



						}

						else{

							$senhaNova = $mysqli->real_escape_string($_POST['senha']);

							if(strlen($senhaNova) > 5){

								if(isset($_POST['email'])){
									
									$nome = $mysqli->real_escape_string($_POST['nome-completo']);

									$cpf = $mysqli->real_escape_string($_POST['cpf']);

									$email = $mysqli->real_escape_string($_POST['email']);

									// $senha = $mysqli->real_escape_string($_POST['senha']);

									$hash = $senhaNova;

									// $hash = password_hash($senha, PASSWORD_BCRYPT);

									$papel = $mysqli->real_escape_string($_POST['papel']);

									$genero = $mysqli->real_escape_string($_POST['genero']);

							//		$cpf = $mysqli->real_escape_string($_POST['cpf']);

									$nascimento = $mysqli->real_escape_string($_POST['data-nascimento']);

									$telefone = $mysqli->real_escape_string($_POST['telefone']);	


									$cep =  $mysqli->real_escape_string($_POST['cep']);

									$logradouro =  $mysqli->real_escape_string($_POST['logradouro']);

									$numero =  $mysqli->real_escape_string($_POST['numero']);

									$bairro =  $mysqli->real_escape_string($_POST['bairro']);

									$cidade =  $mysqli->real_escape_string($_POST['cidade']);

									$pais =  $mysqli->real_escape_string($_POST['pais']);

									$referencia =  $mysqli->real_escape_string($_POST['ponto-referencia']);
								
									if($quantidade > 0) {

										while($user = $sql_query->fetch_object()){

											if($user->email == $_POST['email'] && $user->id != $_POST['id']){

												$emailUtilizado = true;

											}	

											if($user->cpfcnpj == $_POST['cpf'] && $user->id != $_POST['id']){

												$cpfUtilizado = true;
				
											}	

										}

									}

									if($emailUtilizado === true){		

										print '<p class="btn-delete btn">E-mail já utilizado.</p>';

										// header("Location: new-user-admin.php");

									}

									else if($cpfUtilizado === true){		

										print '<p class="btn-delete btn">CPF já utilizado.</p>';

										// header("Location: new-user-admin.php");

									}

									else{

		//									$id = $mysqli->real_escape_string($_POST['id']);

										$sql_code = "UPDATE usuario SET nome='{$nome}', cpfcnpj='{$cpf}', email='{$email}', senha='{$hash}', papel='{$papel}', genero='{$genero}', data_nascimento='{$nascimento}', telefone='{$telefone}', cep='{$cep}', rua='{$logradouro}', numero='{$numero}', bairro='{$bairro}', cidade='{$cidade}', pais='{$pais}', complemento='{$referencia}' WHERE id=".$id;

										$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

										$avatar = $_FILES['avatar'];

										$novoNomeDoArquivo = '';

										if($avatar['name']){				
													
											$pasta = "img/users/";

											$nomeDoArquivo = $avatar['name'];

											$novoNomeDoArquivo = uniqid();

											$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

											$path = $pasta . $novoNomeDoArquivo . "." . $extensao;


											$deu_certo = move_uploaded_file($avatar["tmp_name"], $path);

											$sql_code = "UPDATE usuario SET avatar='{$novoNomeDoArquivo}', extensao='{$extensao}' WHERE id=".$id;

											$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
																			
										}

		//									$foto = $_FILES['foto'];

										// header("Location: panel-users.php");	

										print '<script>    
										
										window.location.href = "panel-users.php";

										</script>';

									}
									
								}
							}

							else{

								print '<div class="btn btn-delete">A senha deve conter no mínimo 6 caracteres!</div>';

							}


						}



					?>



						
						
					 <?php 

						if(isset($_GET['id'])){

							print '
							<div class="form-group full-width">
								
								<h2>Editar Usuário</h2>
								
							</div>';
							
							print '<input type="hidden" name="id" value="'.$id.'" required>';
							
						}					
						
						else{

							print '
							<div class="form-group full-width">
								
								<h2>Novo Usuário</h2>
								
							</div>';

						}
						
						
					?>

					<?php 

						if($avatar != ''){

							print '<img src="img/users/'.$avatar.'.'.$extensao.'" width=250  id="img-atual">
							
							<label  for="upload" class="upload"  style="display: none">

								<span class="upload-image">	</span>

							</label>			
							
							<div class="actions full-width">
							
								<a class="btn btn-primary" id="change-image">Alterar Foto</a>
							</div>
							';


							}

							else{
									
									
								print '<img src="img/user.png" width=250  id="img-atual">
								
									<label  for="upload" class="upload"  style="display: none">
		
									<span class="upload-image">	</span>

								</label>			
								
								<div class="actions full-width">
								
									<a class="btn btn-primary" id="change-image">Alterar Foto</a>
								</div>';
								
							}

					?>

					<input type="file" name="avatar" id="upload" accept="image/*" >


						
					<div class="form-group full-width">

						<label for="nome-completo">Nome Completo:</label>
						<input type="text" id="nome-completo" name="nome-completo" value="<?php echo $nome; ?>" required placeholder="Digite o nome completo do usuário aqui">

					</div>

					<div class="form-group full-width">

						<label for="cpf">CPF:</label>
						<input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" required placeholder="Digite o CPF do usuário aqui" onkeypress="$(this).mask('000.000.000-00')">

					</div>
					
					
					 <div class="form-group">

						<label for="email">E-mail:</label>
						<input type="text" id="email" name="email" value="<?php echo $email; ?>" required placeholder="Digite o e-mail do usuário aqui"> 

					</div>
						
						
					 <div class="form-group">

						<label for="senha">Senha:</label>
						<input type="password" id="senha" name="senha" value="<?php echo $user->senha; ?>" required placeholder="Digite a senha do usuário aqui">

					</div>
						
					<div class="form-group">

						<label for="papel">Papel:</label>
						
						<select id="papel" name="papel" required data-value="<?php echo $papel; ?>"> 
						
							<option value="cliente" selected>Cliente</option>

							<?php

								if($_SESSION['papel'] == 'admin'){

							?>
									<option value="colaborador">Colaborador</option>

									<option value="admin">Admin</option>

							<?php

								}

							?>

						
						</select>

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

					
					<div class="form-group-radio full-width" id="generoContainer" data-value="<?php echo $genero; ?>">

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
						

					<div class="form-group">

						<label for="cep">Cep:</label>
						<input type="text" id="cep" name="cep" required onkeypress="$(this).mask('00000-000')" value="<?php echo $cep; ?>" required placeholder="99999-999">
						<a class="actions btn btn-primary" onclick="buscarEndereco()">Buscar Endereço</a>


					</div>


					<div class="form-group">

						<label for="logradouro">Logradouro:</label>
						<input type="text" id="logradouro" name="logradouro"  value="<?php echo $logradouro; ?>" required placeholder="Clique em Buscar Endereço para preencher o logradouro" readonly>

					</div>

					<div class="form-group">

						<label for="numero">Numero:</label>
						<input type="text" id="numero" name="numero"  value="<?php echo $numero; ?>" required placeholder="Digite o número do seu endereço aqui">

					</div>


					<div class="form-group">

						<label for="bairro">Bairro:</label>
						<input type="text" id="bairro" name="bairro"  value="<?php echo $bairro; ?>" required placeholder="Clique em Buscar Endereço para preencher o bairro" readonly>

					</div>

					<div class="form-group">

						<label for="cidade">Cidade:</label>
						<input type="text" id="cidade" name="cidade"  value="<?php echo $cidade; ?>" required placeholder="Clique em Buscar Endereço para preencher a cidade" readonly>

					</div>

					<div class="form-group">

						<label for="pais">Pais:</label>
						<input type="text" id="pais" name="pais"  value="<?php echo $pais; ?>" required placeholder="Clique em Buscar Endereço para preencher o pais" readonly>

					</div>


					<div class="form-group full-width">

						<label for="ponto-referencia">Ponto de Referência:</label>
						<input type="text" id="ponto-referencia" name="ponto-referencia"  value="<?php echo $referencia; ?>" required placeholder="Digite o ponto de referência aqui">

					</div>





					<div class="form-group flex flex-wrap justify-content-space-betwen full-width">
						
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


<script>
  function buscarEndereco() {
    var cep = document.getElementById("cep").value;
    var url = "https://viacep.com.br/ws/" + cep + "/json/";

    fetch(url, { method: 'GET' })
      .then(response => response.json())
      .then(data => {
        console.log(data);
        
        document.getElementById("logradouro").value = data.logradouro;
        document.getElementById("bairro").value = data.bairro;
        document.getElementById("cidade").value = data.localidade;
		document.getElementById("pais").value = "Brasil";
        
      })
      .catch(error => {
        console.log("Erro ao buscar o endereço:", error);
      });
  }
</script>


    </body>



</html>
