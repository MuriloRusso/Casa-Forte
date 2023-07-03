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
		
				
				$sql_code = "SELECT * FROM pedido";	
				
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
				$quantidade = $sql_query->num_rows;
				
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

							<div>
							
								'.$row->DataCompra.'
								
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