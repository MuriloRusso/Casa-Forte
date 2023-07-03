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
			
				$post;
			
				 if(isset($_GET['id'])){

					 $id = $_GET['id'];
					 

					$sql_code = "SELECT * FROM posts WHERE id='".$id."'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					 
					$post = $sql_query->fetch_object();
					 

				 }
			
			
				else{
				
					
				}

            ?>
			
			
			
			
			<section>

				<form method="post" action="config/create-post.php"  enctype="multipart/form-data">


					<div class="form-group">
						<h2>Novo Post</h2>
					</div>

						
					<?php 

						if(isset($_GET['id'])){
							
							?>
					
								<input name="id" type="hidden" value="<?php echo $post->id; ?>">
					
							<?php 
							
						}
					
					
					?>
					
<!--					<input name="id" type="hidden" value="<?php echo $post->id; ?>">-->
					
					<div class="form-group">

						<label for="nome">Titulo do Post:</label>
						<input type="text" id="nome" name="nome" value="<?php echo $post->titulo; ?>" required placeholder="Digite o titulo do post aqui">

					</div>

					 <!-- <div class="form-group">

						<label for="capa">Capa do Post:</label>
						<input type="file" id="capa" name="capa" value="" required>

					</div> -->

					<div>

						<?php 

							if(isset($_GET['id'])){

								print '
																	
									<img src="img/posts/'.$post->arquivo.''.$post->extensao.'" id="img-atual">	
									
								
								';

							}

						?>
						<label  for="upload" class='upload'>
		
							<span class="upload-image">	</span>

						</label>					
						<input name="capa" type="file" accept="image/*" id="upload">

						<?php 

							//  if(isset($_GET['id']) ){

							// 	print '<img src="img/posts/'.$post->arquivo.''.$post->extensao.'" id="img-atual">								
								
							// 	<a onclick="alter()" class="btn btn-primary">Alterar Imagem</a>';

							//  }

						?>

						<script>

							// const alter = () => {
								
							// 	document.querySelector(`.upload`).click();
							
							// 	document.querySelector('#img-atual').style.display = 'none';
							
							// }

						</script>

					</div>


					 <div class="form-group">

						<label for="texto">Texto:</label>
						<textarea type="text" id="texto" name="texto" required placeholder="Digite a descrição do seu texto aqui"><?php echo $post->texto; ?></textarea>

					</div>


					<div class="form-submit-group flex flex-wrap justify-content-space-betwen">

						
						<?php 

							if(!isset($_GET['id'])){

								?>

								<input class="btn-primary" type="submit" id="submit" value="Criar Post">
						
								<?php 

							}
						
							else{
								
								?>

									<input class="btn-primary" type="submit" id="submit" value="Atualizar Post">
						
								<?php 


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
        



    </body>



</html>