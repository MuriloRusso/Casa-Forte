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
		
				
				// $sql_code = "SELECT * FROM pedido";	
				
				// $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
				// $quantidade = $sql_query->num_rows;

				$sql_code = "SELECT * FROM pedido";

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
			
				$quantidade = $sql_query->num_rows;

				if(!isset($_GET['page'])){

					$sql_code = "SELECT * FROM pedido ORDER BY id DESC LIMIT 0, 10";
			
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
			
				}
			
				else{
			
					$page = intval($_GET['page']) - 1;
			
					$sql_code = "SELECT * FROM pedido ORDER BY id DESC LIMIT ".$page."0, 10";
			
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
			
			
				}

				// $quantidade = $sql_query->num_rows;
				
				print '
				
					<h1 class="text-center full-width">Pedidos</h1>
					
					<ul class="full-width">
				
				';
								

 				while($row = $sql_query->fetch_object()){

					print '
					
						<li class="flex card justify-content-space-betwen flex-wrap">

							<div>
							
								Pedido: '.$row->ID.'
								
							</div>

							<div class="date">

								<span>
							
									'.$row->DataCompra.'

								</span>
								
							</div>	

							<div>
							
								'.$row->Status.'
								
							</div>	
							
							
							<div>

								<a href="pedido.php?id='.$row->ID.'" class="full-mobile btn btn-primary" title="Clique nesse botão para ver mais detalhes">

									Ver

								</a>
							
							</div>	
							
						</li>

					';

                }    	
				
				
				if($quantidade > 10){

					$numPages = (intval($quantidade / 10)) + 1;
				
		//		$numPages = ceil((intval($quantidadeProdutos / 10)));
		
				print '
		
				<div class="pagination full-width flex justify-content-center">';
		
		
				for($a = 1; $a < $numPages+1; $a++){
		
			//		print '<a href="blog.php?page='.$a.'">'.$a.'</a>';
		
					if($a == $_GET['page'] || (!isset($_GET['page']) && $a == 1)){
		
						print '<a href="vendas.php?page='.$a.'" class="btn-pagination-active">'.$a.'</a>';
		
					}
		
					else{
		
						print '<a href="vendas.php?page='.$a.'">'.$a.'</a>';
		
		
					}
		
		
				}
		
		
				print '</div>';
					
		
			}
				

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

	<script src="js/mascara-data.js"></script>



</html>