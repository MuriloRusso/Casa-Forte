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

                        $passwordConfirm = $mysqli->real_escape_string($_POST['passwordConfirm']);

                        $newPassword = $mysqli->real_escape_string($_POST['newPassword']);

                        $id = $mysqli->real_escape_string($_POST['id']);

                        $sql_code = "SELECT * FROM usuario WHERE id=".$id;

                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                        $user = $sql_query->fetch_object();

                        if($newPassword == $passwordConfirm){//confirmação não confere
                                
                            if($user->senha != $newPassword){//verifica se senha antiga e nova são iguais

                                $sql_code = "UPDATE usuario SET senha='{$newPassword}' WHERE id=".$id;

                                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                                print '<p class="alert-sucess text-center">Senha Alterada com sucesso</p>';

                            }                   
                            else{

                                print '<p class="btn-delete btn">Senha nova é igual a atual</p>';

                            }     

                        }

                        else{

                            print '<p class="btn-delete btn">Senhas não conferem.</p>';

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

                        // $horario = date('H:i:s');

                         $horario = date('H:i');

                        // $hora_envio = explode($row->horario, ':');

                        // $intervalo = abs( $row->horario - $horario ) / 60;

                        // print $row->horario.'<br>';

                        // print  $hora_envio[1].'<br>';

                        // print $horario.'<br>';

                        // print $intervalo;

                        if($row->data_envio == $data_atual/* && $intervalo < 5*/) {

                        

                            // if( $intervalo > 30 ) {
                            // // 
                            // }

                        // $sql_code = "SELECT * FROM usuario WHERE id=".$row->id_usuario;

                        // $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                 

                    
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

					<div class="form-group-submit actions flex">

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