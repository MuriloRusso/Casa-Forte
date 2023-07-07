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

    <body id="" class=''>

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<section>

			<?php 
				
				
				print '
    
    
				<div class="container-posts flex justify-content-center flex-wrap">
		
					<div class="flex justify-content-space-around flex-wrap full-width align-items-center">
				
						   <h2 class="text-center">Ambiente Externo:</h2>
				
			';
				
				if($_SESSION['papel'] == 'admin'){
					
					
					print '<div class="flex justify-content-center">
					<a href="new-product.php" class="btn btn-primary" title="Clique nesse botão para adicionar um novo produto">Novo</a></div>';
						
				
					print '
					
					<div class="full-width flex justify-content-center actions">

						<form action="categorizar.php" method="post" class="form-clean">
						
							<input type="hidden" value="1" name="id_categoria">
						
							<input type="submit" class="btn btn-primary" value="Incluir Nessa Categoria">

							<input type="submit" class="btn btn-delete actions" id="remove" value="Remover Dessa Categoria">

							

						</form>

					</div>
					
					
					';

				}

				print '</div>';




				
				$sql_code = "SELECT * FROM categorizar WHERE ID_categoria=1";	
				
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
				$quantidade = $sql_query->num_rows;
				
				if(!isset($_GET['page'])){

					$sql_code = "SELECT * FROM categorizar WHERE ID_categoria=1 ORDER BY id DESC LIMIT 0, 10";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

				}

				else{

					$page = intval($_GET['page']) - 1;

					$sql_code = "SELECT * FROM categorizar WHERE ID_categoria=1 ORDER BY id DESC LIMIT ".$page."0, 10";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


					
				}

				


 				while($row = $sql_query->fetch_object()){
														
					$idProduto = $row->ID_produto;
										
					$sql_code2 = "SELECT * FROM produtos WHERE id='{$idProduto}'";
					
					$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
//
					while($produto = $sql_query2->fetch_object()){

						print '
							<a href="product.php?id='.$produto->id.'" class="font-white">

								<div class="card">

									<img src="img/products/'.$produto->arquivo.''.$produto->extensao.'">

									<h3>'.$produto->nome.'<h3/>

									<p class="price">R$: '.$produto->preco.'<p/>

									<p class="parc">Em Até '.$produto->NumeroParcelas.'X no cartão.<p/>
					
									<p class="desc">'.$produto->descricao.'<p/>    


									<a href="product.php?id='.$produto->id.'">Ver Mais</a>
									
									
									';

									if($_SESSION['papel'] == 'admin'){

										print '


										<div class="flex flex-wrap justify-content-space-betwen actions">

											<a href="delete-product.php?id='.$produto->id.'" class="btn btn-delete" title="Clique nesse botão para excluir o produto">Excluir</a>

											<a href="new-product.php?id='.$produto->id.'" class="btn btn-primary" title="Clique nesse botão para editar o produto">Editar</a>


										</div>';


									}


									print'


								</div>

							</a>';


					
					}


//					print 'id '.$row->ID.' cliente '.$row->ID_Cliente.' produto '.$row->ID_Produtos;
					
                }    
				
				
				if($quantidade > 10){

						$numPages = (intval($quantidade / 10)) + 1;

					//	$numPages = ceil((intval($quantidadeProdutos / 10)));

						if(intval($quantidade) / 10 === 0){

							$numPages = $numPages - 1;

						}


						print '

						<div class="pagination full-width flex justify-content-center">';


						for($a = 1; $a < $numPages+1; $a++){



							if($a == $_GET['page'] || (!isset($_GET['page']) && $a == 1)){

								print '<a href="ambiente.php?page='.$a.'" class="btn-pagination-active">'.$a.'</a>';

							}

							else{

								print '<a href="ambiente.php?page='.$a.'">'.$a.'</a>';


							}


						}


					print '</div>';


					}



				
				
				print '</div>';
				

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
		

		<script>

			document.querySelector('#remove').onclick = function(){

				document.querySelector('form').action = 'remove-category.php';

			}


		</script>

		  
		<script>
			
			document.querySelector('#btn-category-1').href = '#';
		
			document.querySelector('#btn-category-1').click();
		
		</script>
        



    </body>



</html>