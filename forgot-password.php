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

                    if(isset($_POST['email'])){

                        $email = $mysqli->real_escape_string($_POST['email']);

                        // $sql_code = "SELECT * FROM usuario WHERE email=".$email;


                        $sql_code = "SELECT * FROM usuario WHERE email = '$email'";

					    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                        $user = $sql_query->fetch_object();
                        
                        $chave = uniqid();

                        $data_envio = date('Y-m-d');

                        $horario = date('H:i:s');

                        if($user){

                            $sql_code = "INSERT INTO forgot_password (id_usuario, chave, data_envio, horario) VALUES ('{$user->id}', '{$chave}', '{$data_envio}', '{$horario}')";

                            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                            
                            
                            print '
                            
                                <p class="alert-sucess text-center">Um e-mail foi enviado para '.$email.' com um link para recuperação da sua senha!</p>
                            
                                <a href="login.php" class="btn actions btn-primary">Voltar</a>


                            ';

                        }

                        else{


                            print '
                            
                                <p class="btn-delete btn text-center">Não foi encontrado nenhum usuário com o e-mail '.$email.' vinculado ao mesmo!</p>
                            
                                <a href="forgot-password.php" class="btn actions btn-primary">Tentar de Novo</a>


                            ';


                        }


                    }

                    else 
                    
                    {
                  
                ?>
                        <div class="form-group">
                            <h2>Preencha o campo abaixo para recuperação da senha!</h2>
                        </div>

                        <div class="form-group">

                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" placeholder="Digite seu e-mail aqui" value="<?php /*echo $_POST['email']*/ ?>">

                        </div>

                        
                        <div class="form-submit-group flex flex-wrap justify-content-space-betwen">

                            <input class="btn-primary" type="submit" id="submit" title="Clique aqui para enviar" value="Enviar E-mail de Redefinição de Senha">

                            <p class="text-center full-width">Já Possui conta? <a class="" href="login.php" title="Já possui conta? Clique aqui">Entre Aqui</a></p>

                        </div>

                    <?php 
                    
                        }
                    
                    ?>


                </form>

            </section>

			<?php 

				include('footer.php');

			?>



        </div>
        



    </body>



</html>