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


			<section class="flex flex-wrap">

			<?php 
		
				
				$sql_code = "SELECT * FROM carrinho WHERE ID_Cliente='{$_SESSION['id']}'";	
				
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
				$quantidadeItens = $sql_query->num_rows;
				
				print '
				
					<h1 class="text-center full-width">Meu Carrinho</h1>
					
					<ul class="col-75">
				
				';
				
				
				
				$valorTotal = 0;
				

 				while($row = $sql_query->fetch_object()){
														
					$idProduto = $row->ID_Produtos;
										
					$sql_code2 = "SELECT * FROM produtos WHERE id='{$idProduto}'";
					
					$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
					
					
					
					//
					while($produto = $sql_query2->fetch_object()){

						$valorTotal = $valorTotal + $produto->preco;
							
						print '

							
							
								<li class="flex card justify-content-space-betwen flex-wrap">
								
									<a href="product.php?id='.$produto->id.'" class="full-mobile">
										<img src="img/products/'.$produto->arquivo.$produto->extensao.'" alt="imagem do produto">

									</a>
									
									<a href="product.php?id='.$produto->id.'" class="col-25 full-mobile">
										<div>
											<h2>'.$produto->nome.'</h2>
										</div>

									</a>

									<div class="full-mobile">
										<a href="config/delete-item-cart.php?id='.$row->ID.'" class="btn btn-delete font-white">Remover</a>
									</div>
									
									<div class="full-mobile">
										<h2>R$ '.$produto->preco.'</h2>
									</div>
									
									
									
								</li>



						';
					
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

							<a class="btn btn-primary">continuar</a>

						</div>


					</div>
				</div>
				
				
				
				';
				

			?>






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