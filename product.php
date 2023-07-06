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
						
						<form action="buy.php" method="post" id="buyForm">

							<div class="card full-mobile">
							
								<div class="border-bottom-gray">
								
									<h2>R$ '.$row->preco.'<h2/>

									<input type="hidden" value="'.$row->preco.'" name="preco">

									<p class="desc">Em Até '.$row->NumeroParcelas.'X no cartão.<p/>      

									<input type="hidden" value="'.$row->NumeroParcelas.'" name="parcelas">
								
								</div>
							
								<div class="border-bottom-gray">
							
								
									<p>Calcule frete e prazo<p/>

									<input type="hidden" value="09371-210" name="sCepOrigem">

									<div class="form-grounp flex">
										

										<input type="text" name="sCepDestino" id="cep" placeholder="digite o CEP">

										<a class="btn btn-primary" id="btn-frete" title="Clique nesse botão para confirmar">OK</a>
										
										<p id="valorFrete"></p>

									</div>

									<input type="hidden" value="'.$row->peso.'" name="nVlPeso">

									<input type="hidden" value="'.$row->comprimento.'" name="nVlComprimento">

									<input type="hidden" value="'.$row->altura.'" name="nVlAltura">

									<input type="hidden" value="'.$row->largura.'" name="nVlLargura">

									<input type="hidden" value="04014" name="nCdServico">

									<p>Quantidade:</p>

									<div class="form-group flex">										

										<input type="number" min="1" name="quantidade" id="quantidade" placeholder="" value="1">


									</div>

																			
										
							
								</div>
							
						
							<div>

	

						';

						if($_SESSION['papel'] === 'cliente'){

							print'
							
									<input type="hidden" value="'.$userId.'" name="id_cliente">
									<input type="hidden" value="'.$row->id.'" name="id_produto">
									<input type="button" class="btn btn-primary" value="Adicionar ao Carrinho" title="Clique nesse botão para adicionar ao carrinho">
									

								
							';

						}

						else{

							print'
						
									<input type="button" class="btn btn-disable" value="Adicionar ao Carrinho" title="Clique nesse botão para adicionar ao carrinho">
								
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

			<script>

				$('#btn-frete').click(function(){

					// let cepRemetente = '09371-210';

					// let peso = document.querySelector('#peso');

					// let altura = document.querySelector('#altura');

					// let largura = document.querySelector('#largura');

					// let comprimento = document.querySelector('#comprimento');

					// let cep = document.querySelector('#cep');

					let formSerialized = $('#buyForm').serialize();


					$.post('calcular-frete.php', formSerialized, function(resultado){

						console.log(resultado);
						resultado = JSON.parse(resultado);
						let valorFrete = resultado.preco;
						console.log('Valor do Frete: ' + valorFrete);
						let prazoEntrega = resultado.prazo;
						$('#valorFrete').html(`O valor do frete é <b>R$ ${valorFrete}</b> e o prazo de entrega é <b>${prazoEntrega} dias úteis</b>.`);


					})


				});

			</script>

    </body>



</html>