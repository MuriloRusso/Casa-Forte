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
					
					use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

                    require 'PHPMailer-master-atual/PHPMailer-master/src/Exception.php';
                    require 'PHPMailer-master-atual/PHPMailer-master/src/PHPMailer.php';
                    require 'PHPMailer-master-atual/PHPMailer-master/src/SMTP.php';


					include('connect.php');

					$nome = $mysqli->real_escape_string($_POST['nome']);

					$email = $mysqli->real_escape_string($_POST['email']);

					$senha = $mysqli->real_escape_string($_POST['password']);

                    $cpfcnpj = $mysqli->real_escape_string($_POST['cpf']);

					
					$Confirmação = $mysqli->real_escape_string($_POST['confirm-password']);


					$papel = 'cliente';



					$sql_code = "SELECT * FROM usuario";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidade = $sql_query->num_rows;

					$emailUtilizado = false;

                    $cpfUtilizado = false;


					if($quantidade > 0) {

						while($row = $sql_query->fetch_object()){

							if($row->email == $_POST['email']){

								$emailUtilizado = true;

							}	

                            if($row->cpfcnpj == $_POST['cpf']){

								$cpfUtilizado = true;

							}	

						}

					}

					if($emailUtilizado === true && $_POST['email'] != ''){				

						print '<p class="btn-delete btn">E-mail já utilizado</p>';

//							header("Location: new-user.php");

					}
					

					else if($cpfUtilizado === true && $_POST['cpf'] != ''){				

						print '<p class="btn-delete btn">CPF já utilizado</p>';

//							header("Location: new-user.php");

					}



					else if($senha != $Confirmação){				

						print '<p class="btn-delete btn">Senha e confirmação não conferem</p>';

//							header("Location: new-user.php");

					}

					else if(strlen($senha) < 6 && $senha != ''){

						print '<div class="btn btn-delete">A senha deve conter no mínimo 6 caracteres!</div>';

					}

					else{

						
						if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password'])){

						$sql_code = "INSERT INTO usuario (nome, email, senha, papel, cpfcnpj) VALUES ('{$nome}', '{$email}', '{$senha}', '{$papel}', '{$cpfcnpj}')";

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

						Foi Criada uma conta com seu e-mail em nossa Loja<br>

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
						
						
						print '<p class="alert-sucess text-center">Usuário criado com sucesso. <a href="login.php">Clique aqui</a> para se logar.</p>';

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

                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" value="<?php echo $_POST['cpf'] ?>" required placeholder="Digite seu e-CPF aqui" onkeypress="$(this).mask('000.000.000-00')">

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