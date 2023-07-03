<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('login-verification.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body class="pages-login">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">


            <section>

                <form method="post" action="">

                <?php 
					

					include('connect.php');

					$nome = $mysqli->real_escape_string($_POST['nome']);

					$email = $mysqli->real_escape_string($_POST['email']);

					$senha = $mysqli->real_escape_string($_POST['password']);
					
					$Confirmação = $mysqli->real_escape_string($_POST['confirm-password']);


					$papel = 'cliente';



					$sql_code = "SELECT * FROM usuario";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidade = $sql_query->num_rows;

					$emailUtilizado = false;

					if($quantidade > 0) {

						while($row = $sql_query->fetch_object()){

							if($row->email == $_POST['email']){

								$emailUtilizado = true;

							}	

						}

					}

					if($emailUtilizado === true && $_POST['email'] != ''){				

						print '<p class="btn-delete">E-mail já utilizado</p>';

//							header("Location: new-user.php");

					}
					
					else if($senha != $Confirmação){				

						print '<p class="btn-delete">Senha e confirmação não conferem</p>';

//							header("Location: new-user.php");

					}

					else{

						
						if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password'])){

						$sql_code = "INSERT INTO usuario (nome, email, senha, papel) VALUES ('{$nome}', '{$email}', '{$senha}', '{$papel}')";

						$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
						
						
						//enviar e-mail
						
//						$nome = $_POST['nome'];
//						$email = $_POST['email'];

					/*	$data_envio = date('d/m/Y');
						$hora_envio = date('H:i:s');


						require 'PHPMailer-master/PHPMailerAutoload.php';

						$mail = new PHPMailer;
						$mail->isSMTP();

						$mail->Host = "email-ssl.com.br";
						$mail->Port = "465";
						$mail->SMTPSecure = "ssl";
						$mail->SMTPAuth = "true";
						$mail->Username = "no-reply@hexait.com.br";
						$mail->Password = "H7667@ngeL";


						$mail->setFrom($mail->Username, 'Casas Forte'); //remetente

						$mail->addAddress($email);

//						$mail->addAttachment('./form-config/file/'.$novoNomeDoArquivo.'.'.$extensao, $nomeOriginal.'.'.$extensao);


						$mail->Subject = 'Sua Conta foi Criada';

						$mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';


						$conteudo_email = " 

							<p>Olá, $nome, foi criado um cadastro com seu e-mail no site <a href='http://casaforteprojetoseservicos.com.br/'>Casas Forte</a> </p>


							<br><br><br>
							
							Este e-mail foi enviado em $data_envio às $hora_envio <br>

						  ";



						$conteudo_email = utf8_decode($conteudo_email);

						$mail->IsHTML(true);
						$mail->Body = $conteudo_email;




						if($mail->send()){

							
							header("Location: ../index.php?alert=sucess");

						}

						else{

							header("Location: index.php?alert=error".$mail->ErrorInfo);

						}



						
						
						
						*/
						
						
						
						
						//--------------------
						
						
						
						print '<p class="alert-sucess">Usuário criado com sucesso. <a href="login.php">Clique aqui</a> para se logar.</p>';

//						header("Location: login.php");
							
						}


					}

                ?>
					
					


                    <div class="form-group">
                        <h2>Preencha os campos abaixo para criar sua conta!</h2>
                    </div>
					
					<div class="form-group">

                        <label for="nome">Nome Completo:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $_POST['nome'] ?>" required placeholder="Digite seu nome completo aqui">

                    </div>

                    <div class="form-group">

                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo $_POST['email'] ?>" required placeholder="Digite seu e-mail aqui">

                    </div>

                    <div class="form-group">

                        <label for="username">Senha:</label>
                        <input type="password" id="password" name="password" value="<?php echo $_POST['password'] ?>" required placeholder="Digite sua senha aqui">

                    </div>

                    <div class="form-group">

                        <label for="username">Confirmação da Senha:</label>
                        <input type="password" id="confirm-password" name="confirm-password" value="<?php echo $_POST['confirm-password'] ?>" required placeholder="Digite novamente sua senha aqui">

                    </div>

                    <div class="form-submit-group flex flex-wrap justify-content-space-betwen">

                        <input class="btn-primary" type="submit" id="submit" title="Clique aqui para criar sua conta" value="Criar Conta">

                        <p class="text-center full-width">Já Possui conta? <a class="" href="login.php" title="Já possui conta? Clique aqui">Entre Aqui</a></p>

                    </div>


                </form>

            </section>
			
			
			<?php 

				include('footer.php');

			?>





        </div>
        



    </body>



</html>