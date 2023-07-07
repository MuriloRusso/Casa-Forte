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

    <body id="page-change-password">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


		<section class="flex flex-wrap justify-content-center">
			
            <div class="card" id="dados">

				<form method="post" action=""  enctype="multipart/form-data">

                <?php 

                    if(isset($_POST['newPassword'])){

                        $chave = $_GET['key'];

                        $sql_code = "SELECT * FROM forgot_password WHERE chave=".$chave;

                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                        $row = $sql_query->fetch_object();

                        $passwordConfirm = $mysqli->real_escape_string($_POST['passwordConfirm']);

                        $newPassword = $mysqli->real_escape_string($_POST['newPassword']);

                        $id = $mysqli->real_escape_string($_POST['id']);
                        

                        $sql_code = "SELECT * FROM usuario WHERE id=".$id;

                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                        $user = $sql_query->fetch_object();

                        if(strlen($newPassword) > 5 && $newPassword != ''){

                            if($newPassword == $passwordConfirm){//confirmação não confere
                                    
                                if($user->senha != $newPassword){//verifica se senha antiga e nova são iguais

                                    $sql_code = "UPDATE usuario SET senha='{$newPassword}' WHERE id=".$id;

                                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                                    $st = 'usado';

                                    $sql_code = "UPDATE forgot_password SET status_key='{$st}' WHERE id=".$row->id;
                                    
                                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                                    
                                    print '<p class="alert-sucess text-center">Senha Alterada com sucesso</p>
                                    
                                    
                                    <script>

                                    setTimeout(function(){

                                        $(".form-group").css("display", "none");

                                        $(".form-group-submit").css("display", "none");

                                    
                                        setTimeout(function(){

                                            window.location.href = "login.php";


                                        }, 2000)
                                


                                    }, 300)
                                    
                                    
                                    </script>';

                                    

                                }                   
                                else{

                                    print '<p class="btn-delete btn">Senha nova é igual a atual</p>';

                                }     

                            }

                            else{

                                print '<p class="btn-delete btn">Senhas não conferem.</p>';

                            }

                        }

                        else{

                            print '<div class="btn btn-delete">A senha deve conter no mínimo 6 caracteres!</div>';

                        }
                        // header("Location: ../my-profile.php");                           

                    }          

                
                ?>

                <?php 

                    if(isset($_GET['key'])){

                        $chave = $_GET['key'];

                        $sql_code = "SELECT * FROM forgot_password WHERE chave=".$chave;

                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                        $row = $sql_query->fetch_object();

                        $data_atual = date('Y-m-d');

                        $horario = date('H:i');


                        // Data/hora atual
                        $dataAtual = time();

                        // Data/hora armazenada na coluna do banco de dados
                        $dataColuna = strtotime($row->horario); // Substitua 'data_coluna' pelo nome da coluna no banco de dados

                        // Tempo máximo permitido em segundos (por exemplo, 1 hora = 3600 segundos)
                        $tempoMaximo = 1800;

                        // // Verifica se o tempo máximo já passou
                        // if (($dataAtual - $dataColuna) > $tempoMaximo) {
                        //     // O tempo máximo já passou
                        //     echo "Já passou o tempo determinado.";
                        // } else {
                        //     // O tempo máximo ainda não passou
                        //     echo "Ainda não passou o tempo determinado.";
                        // }

                        print $dataAtual.'<br>';

                        print $dataColuna.'<br>';


                        print $dataAtual - $dataColuna.'<br>';

                        if($row->data_envio == $data_atual && $row->status_key != 'usado' && (($dataAtual - $dataColuna) < $tempoMaximo)) {
                    
                ?>

                            <div class="form-group">
                                <h2>Recuperar Senha</h2>
                            </div>
                            
                                                
                            <input type="hidden" id="id" name="id" value="<?php echo $row->id_usuario; ?>">
                            
                            
                            <div class="form-group">

                                <label for="newPassword">Nova Senha:</label>
                                <input type="password" id="newPassword" name="newPassword" placeholder="Digite aqui a nova senha">

                            </div>
                            
                            <div class="form-group">

                                <label for="passwordConfirm">Confirme a Nova Senha:</label>
                                <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirme aqui a senha atual">

                            </div>

                            <div class="form-group-submit actions">

                                <input type="submit" value="Alterar Senha" class="btn btn-primary" title="Alterar Senha">

                            </div>

				<?php

                        }

                        else{

                            print '<p class="btn-delete btn">Link Expirado!</p>';

                        }
                
                    }
                
                ?>

				</form>
			
			
			</div>
			
			
		</section>


			<?php 

				include('footer.php');

			?>



        </div>
        
	

    </body>



</html>