<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect.php');

		 include('protect-cliente.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="page-carrinho" class='page-cards'>

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<form action="buy-carrinho.php" class="form-clean" method="post">

				<section class="flex flex-wrap">

					<?php 
										
						$sql_code = "SELECT * FROM carrinho WHERE ID_Cliente='{$_SESSION['id']}'";	
						
						$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
										
						$quantidadeItens = $sql_query->num_rows;
						
						print '
						
							<h1 class="text-center full-width">Meu Carrinho</h1>
							
							<ul class="col-75">

							<input type="hidden" name="quantidade-itens" value="'.$quantidadeItens.'">
						
						';
																	
						$valorTotal = 0;

						$cont = 1;			

						while($row = $sql_query->fetch_object()){
																
							$idProduto = $row->ID_Produtos;
												
							$sql_code2 = "SELECT * FROM produtos WHERE id='{$idProduto}'";
							
							$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
							
							
							//
							while($produto = $sql_query2->fetch_object()){

								$valorTotal = $valorTotal + ($produto->preco * $row->quantidade);
									
								print '						
								
									<li class="flex card justify-content-space-betwen flex-wrap">

										<input type="hidden" name="idProduto'.$cont.'" value="'.$produto->id.'">
									
										<a href="product.php?id='.$produto->id.'" class="full-mobile">
											<img src="img/products/'.$produto->arquivo.$produto->extensao.'" alt="imagem do produto">

										</a>
										
										<a href="product.php?id='.$produto->id.'" class="col-25 full-mobile">
											<div>
												<h2>'.$produto->nome.'</h2>
											</div>

										</a>

										<div class="full-mobile">

											<label for="quantidade'.$cont.'">Quantidade:</label>

											<div class="form-grounp flex">										

												<input type="number" min="1" name="quantidade'.$cont.'" id="quantidade'.$cont.'" placeholder="" value="'.$row->quantidade.'">


											</div>

											<a href="config/delete-item-cart.php?id='.$row->ID.'" class="btn btn-delete font-white">Remover</a>
										</div>
										
										<div class="full-mobile">
											<h2>R$ '.$produto->preco.'</h2>
										</div>
										
									</li>

								';

								$cont = $cont+1;
							
							}


		//					print 'id '.$row->id.' cliente '.$row->ID_Cliente.' produto '.$row->ID_Produtos;
							
						}    
						
						print '</ul>
						
						<div class="col-25">
							<div class="card">

								<h2>Resumo do Pedido</h2>

								<div class="flex justify-content-space-betwen border-bottom-gray">
									<p>'.$quantidadeItens.' Produtos</p>
									
									<p>R$ '.number_format($valorTotal, 2, ',', '.').'</p>
								
								</div>

								<div class="flex justify-content-space-betwen border-bottom-gray">

									<h3>total:</h3>
									
								
									<h3>R$ '.number_format($valorTotal, 2, ',', '.').'</h3>
								</div>

								<div>

									<input type="submit" class="btn btn-primary" value="Continuar">

								</div>


							</div>
						</div>
						
						
						
						';
						

					?>

				</section>

			</form>
	



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