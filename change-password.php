<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect.php');

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

                    // include('connect.php');

                    // error_reporting(1);

                    if(isset($_POST['password'])){

                        $password = $mysqli->real_escape_string($_POST['password']);

                        $passwordConfirm = $mysqli->real_escape_string($_POST['passwordConfirm']);

                        $newPassword = $mysqli->real_escape_string($_POST['newPassword']);

                        $id = $mysqli->real_escape_string($_POST['id']);

                        $sql_code = "SELECT * FROM usuario WHERE id=".$id;

                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                        $user = $sql_query->fetch_object();

                        if(strlen($newPassword) > 5 && $newPassword != ''){

                            if($newPassword == $passwordConfirm){//confirmação não confere

                                if($user->senha == $password){//senha atual incorreta 
                                    
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

                                    print '<p class="btn-delete btn">Senha Incorreta</p>';

                                }


                            }

                            else{

                                print '<p class="btn-delete btn">Confirmação da Senha incorreta</p>';

                            }

                        }

                        else{

                            print '<div class="btn btn-delete">A senha deve conter no mínimo 6 caracteres!</div>';

                        }
                        // header("Location: ../my-profile.php");                           

                    }          

                
                ?>


					<div class="form-group">
						<h2>Alterar Senha</h2>
					</div>
					
										
					<input type="hidden" id="id" name="id" value="<?php echo $usuario['id'] ?>">
					
					<div class="form-group">

						<label for="password">Senha Atual:</label>
						<input type="password" id="password" name="password" placeholder="Digite aqui a senha atual">

					</div>


                    <div class="form-group">

						<label for="newPassword">Nova Senha:</label>
						<input type="password" id="newPassword" name="newPassword" placeholder="Digite aqui a nova senha">

					</div>

                    <div class="form-group">

						<label for="passwordConfirm">Confirme a Nova Senha:</label>
						<input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirme aqui a senha atual">

					</div>
					
					<div class="form-group-submit actions flex">

                        <a href="my-profile.php" class="btn btn-delete">Cancelar</a>

						<input type="submit" value="Alterar Senha" class="btn btn-primary" title="Clique aqui para atualizar seu perfil">

					</div>

				
				</form>
			
			
			</div>
			
			
			
			

		</section>



			<?php 

				include('footer.php');

			?>



        </div>
        
	



    </body>



</html>