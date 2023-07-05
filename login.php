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

                    // include('connect.php');


                    if(isset($_POST['username']) || isset($_POST['password'])){

                        if(strlen($_POST['username']) == 0){

                            echo "<p class='btn-delete btn'>Nome de usuário em Branco</p>";

                        }

                        else if(strlen($_POST['password']) == 0){

                            echo "<p class='btn-delete btn'>Preencha o campo Senha</p>";

                        }

                        else{

                            $user = $mysqli->real_escape_string($_POST['username']);
                            $senha = $mysqli->real_escape_string($_POST['password']);
                            $hash = $senha;
                            $hash = password_hash($senha, PASSWORD_BCRYPT);
                            // $hash = obterHashDoBancoDeDados($user); // substitua pela função que obtém o hash do banco de dados

                            // if (crypt($senha, $hash) === $hash) {

                            //     print 'Senha OK!';

                            //     } else {
                            //         print 'Senha incorreta!';
                            //     }

                            $sql_code = "SELECT * FROM usuario WHERE email = '$user' AND senha = '$hash'";
                            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                            $quantidade = $sql_query->num_rows;

                            if($quantidade == 1) {

                                $usuario = $sql_query->fetch_assoc();

                                if(!isset($_SESSION)){

                                    session_start();


                                }

                                $_SESSION['id'] = $usuario['id'];
                                $_SESSION['nome'] = $usuario['nome'];
                                $_SESSION['email'] = $usuario['email'];
                                $_SESSION['papel'] = $usuario['papel'];
                                $_SESSION['data_nascimento'] = $usuario['data_nascimento'];
                                $_SESSION['telefone'] = $usuario['telefone'];
                                $_SESSION['rua'] = $usuario['rua'];
                                $_SESSION['telefone'] = $usuario['telefone'];
                                $_SESSION['cep'] = $usuario['cep'];
                                $_SESSION['numero'] = $usuario['numero'];
                                $_SESSION['cidade'] = $usuario['cidade'];
                                $_SESSION['estado'] = $usuario['estado'];
                                $_SESSION['complemento'] = $usuario['complemento'];
                                $_SESSION['avatar'] = $usuario['avatar'];

                                header("Location: index.php");

                            }

                            else{

                                echo "<p class='btn-delete btn'>Falha ao Logar, email ou senha incorretos!</p>";

                            }

                        }

                    }

                ?>


                    <div class="form-group">
                        <h2>Preencha os campos abaixo para se logar</h2>
                    </div>

                    <div class="form-group">

                        <label for="username">Usuário:</label>
                        <input type="text" id="username" name="username" required value="<?php echo $_POST['username'] ?>" placeholder="Digite seu e-mail aqui">

                    </div>

                    <div class="form-group">

                        <label for="password" class="full-width flex justify-content-space-betwen">Senha: <a href="forgot-password.php" title="Clique aqui para recuperar a senha">Esqueci minha senha</a></label>
                        <input type="password" id="password" name="password" required value="<?php echo $_POST['password'] ?>" placeholder="Digite seu senha aqui">

                    </div>

                    <div class="form-submit-group flex flex-wrap justify-content-space-betwen">

                        <input class="btn-primary" type="submit" id="submit" title="Clique aqui para entrar" value="Entrar">

                        <p class="text-center full-width">Não Tem um conta? <a class="" href="new-user.php" title="Clique aqui para criar conta">Criar Aqui</a></p>

                    </div>


                </form>

            </section>

			<?php 

				include('footer.php');

			?>




        </div>
        



    </body>



</html>