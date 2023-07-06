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
			
				$product;
			
				 if(isset($_GET['id'])){

					 $id = $_GET['id'];
					 

					$sql_code = "SELECT * FROM produtos WHERE id='".$id."'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					 
					$product = $sql_query->fetch_object();
					 

				 }
			
			
				else{
				
					
				}

            ?>
			
			
			<section>

				<form method="post" action="config/create-product.php"  enctype="multipart/form-data">


					<div class="form-group">
						<h2>Novo Produto</h2>
					</div>
					
					<?php 

						if(isset($_GET['id'])){
							
							?>
					
								<input name="id" type="hidden" value="<?php echo $product->id; ?>">
					
							<?php 
							
						}
					
					
					?>
					
<!--					<input name="id" type="hidden" value="<?php echo $product->id; ?>">-->
					
					<div class="form-group">

						<label for="nome">Nome:</label>
						<input type="text" id="nome" name="nome" value="<?php echo $product->nome; ?>" required placeholder="Digite o nome do produto aqui">

					</div>

					<div class="form-group">

						<label for="descricao">Descrição:</label>
						<textarea type="text" id="descricao" name="descricao" placeholder="Digite a descrição do produto aqui" required><?php echo $product->descricao; ?></textarea>

					</div>

					 <div class="form-group">

						<label for="preco">Preço:</label>
						<input type="text" id="preco" name="preco" value="<?php echo $product->preco; ?>" required>
						
					</div>

					<div class="form-group">

						<label for="peso">Peso:</label>
						<input type="text" id="peso" name="peso" value="<?php echo $product->peso; ?>" required>
						
					</div>

					<div class="form-group">

						<label for="altura">Altura:</label>
						<input type="text" id="altura" name="altura" value="<?php echo $product->altura; ?>" required>
						
					</div>

					<div class="form-group">

						<label for="largura">Largura:</label>
						<input type="text" id="largura" name="largura" value="<?php echo $product->largura; ?>" required>
						
					</div>

					<div class="form-group">

						<label for="comprimento">Comprimento:</label>
						<input type="text" id="comprimento" name="comprimento" value="<?php echo $product->comprimento; ?>" required>
						
					</div>
					
					

					<div class="form-group">

						<label for="parcelas">Numero de Parcelas:</label>
						<input type="text" id="parcelas" name="parcelas"  pattern="[1-9][0-9]*" value="<?php echo $product->NumeroParcelas; ?>" required onkeypress="$(this).mask('000')" placeholder="Digite o número de parcelas aqui">

					</div>

					
					<div class="form-group">
						
						<label for="foto">Foto do Produto:</label>
					
						 <?php 

							 if(isset($_GET['id']) ){

								print '<img src="img/products/'.$product->arquivo.''.$product->extensao.'" id="img-atual">
								
								<label  for="upload" class="upload"  style="display: none">
		
									<span class="upload-image">	</span>

								</label>			
								
								<div class="actions">
								
									<a class="btn btn-primary" id="change-image">Alterar Foto</a>
								</div>
								';


							 }

							 else{

								print '								
								<label  for="upload" class="upload">
		
									<span class="upload-image">	</span>

								</label>			
								
						
								';


							 }

						?>

						
						<input type="file" id="upload" name="foto" accept="image/*" >

					</div>


					<div class="form-submit-group flex flex-wrap justify-content-space-betwen">

					<?php

						if(isset($_GET['id'])){

							
					?>

					<input class="btn-primary" type="submit" id="submit" title="Clique aqui para Atualizar o produto" value="Atualizar Produto">

					<?php

						}
						else{
							
					?>

						<input class="btn-primary" type="submit" id="submit" title="Clique aqui para criar o produto" value="Criar Produto">

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