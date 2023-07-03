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

    <body id="delete-address">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');
			
				$id;
			
				 if(!isset($_GET['id'])){
					 					 
					 header("Location: index.php");					 

				 }
			
				else{
					
					$id = $_GET['id'];		
					
					$sql_code = "SELECT * FROM endereco WHERE id='".$id."'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					 
					$row = $sql_query->fetch_object();
					
				}
			

            ?>
			
			
			<section>

				<form method="post" action="config/delete-address.php"  enctype="multipart/form-data">


					<div class="form-group">
						<p>Você tem certeza de que deseja excluir o Endereço abaixo:</p>
					</div>
					
					<input type="hidden" name="id" value="<?php echo $id; ?>">

					<div class="form-group">

						<label for="nome">Endereço:</label>
						<input type="text" id="nome" name="nome" value="<?php echo $row->nome_endereco; ?>">

					</div>
					
					<div class="form-submit-group flex  justify-content-space-betwen">

						<a class="btn-primary btn" href="my-profile.php">Cancelar</a>
						
						<input class="btn-delete" type="submit" id="submit" value="Excluir Endereço">

					</div>



				</form>

			</section>




			
			<?php 

				include('footer.php');

			?>





        </div>
        



    </body>



</html>