<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="page-product">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');
                

            ?>


            <section class="flex flex-wrap justify-content-center">

            <?php 

            $sql_code = "SELECT * FROM produtos";

            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                
			$userId = $_SESSION['id'];
                while($row = $sql_query->fetch_object()){

                    if($row->id == $_GET['id']){

                        print '
												
						<div class="card full-mobile flex flex-wrap">
						
							<div class="full-width">
								 <img src="img/products/'.$row->arquivo.''.$row->extensao.'">
								
							</div>
							
							<div class="full-width">
							
								<div class="container">
								
									<h1>'.$row->nome.'</h1>
									
									<p style="color: gray !important">'.$row->descricao.'<p/>
								
								';
						
						
								if($_SESSION['papel'] == 'admin'){

									print '


									<div class="flex flex-wrap justify-content-space-betwen actions">

										<a href="delete-product.php?id='.$row->id.'" class="btn btn-delete">Excluir</a>

										<a href="new-product.php?id='.$row->id.'" class="btn btn-primary">Editar</a>


									</div>';


								}
								
						
						
						
								print '
								</div>
							
							
							</div>
							
							
							
                        </div>
						
						<div>
						
						<div class="card full-mobile">
						
						<div class="border-bottom-gray">
						
							<h2>R$ '.$row->preco.'<h2/>
							
							<p class="desc">Em Até '.$row->NumeroParcelas.'X no cartão.<p/>      
						
						</div>
						
						<div class="border-bottom-gray">
						
							<form action="" method="post">
							
								<p>Calcule frete e prazo<p/>
								
								<div class="form-grounp flex">
								
									<input type="text" name="cep" id="cep" placeholder="digite o CEP">

									<input type="submit" class="btn btn-primary" value="OK" id="btn-frete" title="Clique nesse botão para confirmar">

								
								</div>
								

							</form>
							
						
						</div>
						
						
						<div>

						';

						if($_SESSION['papel'] === 'cliente'){

							print'
							
								<form action="config/add-carrinho.php" method="post">
									<input type="hidden" value="'.$userId.'" name="id_cliente">
									<input type="hidden" value="'.$row->id.'" name="id_produto">
									<input type="submit" class="btn btn-primary" value="Adicionar ao Carrinho" title="Clique nesse botão para adicionar ao carrinho">
									

								</form>
								
							';

						}

						else{

							print'
						
								<form action="" method="post">
									<input type="submit" class="btn btn-disable" value="Adicionar ao Carrinho" title="Clique nesse botão para adicionar ao carrinho">
								</form>
								
							';

						}

						if($_SESSION['papel'] === 'cliente'){

							print'
							
							<form action="buy.php" method="post">

								<input type="submit" class="btn btn-primary" value="Comprar" title="Clique nesse botão para comprar o produto">


							</form>
								
							';

						}


						else{

							print'
						
							<form action="" method="post">

								<input type="submit" class="btn btn-disable" value="Comprar" title="Clique nesse botão para comprar o produto">


							</form>
									
							';

						}


						print'												
						
						</div>

					</div>
                        
					</div>	
						
						
						
						
						';

                    }

                }                            

            ?>      

            </section>
			
			
			<?php 

				include('footer.php');

			?>


        </div>    



    </body>



</html>