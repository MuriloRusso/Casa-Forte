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

    <body id="page-meus-pedidos" class='page-cards'>

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<section>

			<?php 

				
				$sql_code = "SELECT * FROM pedido WHERE ID_Cliente='{$_SESSION['id']}'";	
				
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
//				$quantidadePedidos = $sql_query->num_rows;
				
				print '<ul>
				
					<h1 class="text-center">Meus Pedidos</h1>
				
				';
				
				

 				while($row = $sql_query->fetch_object()){
														
					$idProduto = $row->ID_Produtos;
										
					$sql_code2 = "SELECT * FROM produtos WHERE id='{$idProduto}'";
					
					$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
//
					while($produto = $sql_query2->fetch_object()){

						print '

							<a href="buy-details.php?id='.$row->ID.'">';
							
							if($row->Status == 'Entregue'){
								
								print '<li class="flex card entregue flex-wrap">
								
								<ul class="flex flex-wrap justify-content-space-betwen full-width">
									
									<li class="full-mobile"><span>Pedido Entregue<span></li>
									
								
									<li class="flex full-mobile"><pre>Recebido dia </pre><span>'.$row->DataEntrega.'</span></li>
								
								</ul>
								
								';
								
							}
						
							else if($row->Status == 'Em transito'){
								
								print '<li class="flex card transito flex-wrap">
								
								
								<ul class="flex flex-wrap justify-content-space-betwen full-width">
									
									<li class="full-mobile"><span>Pedido Em Trânsito<span></li>
									
									<li class="flex full-mobile"><pre>Previsão de Entrega dia </pre><span>'.$row->DataPrevisaoEntrega.'</span></li>
								
								</ul>
								
								';
								
							}
						
							else if($row->Status == 'Cancelada'){
								
								print '<li class="flex card cancelada flex-wrap">
								
								
								<ul class="flex  justify-content-space-betwen full-width">
									
									<li><span>Pedido Cancelado<span></li>
									
								
								</ul>
								
								';
								
							}
							
							print '
							
							<div class="flex flex-wrap full-mobile">
								<img src="img/products/'.$produto->arquivo.$produto->extensao.'">
									
									<div class="container full-mobile">
										<h2>'.$produto->nome.'</h2>
										<p>Status da Compra: '.$row->Status.'</p>
										<p>Data da Compra: '.$row->DataCompra.'</p>
										<p>Previsão de Entrega: '.$row->DataPrevisaoEntrega.'</p>
										<p>Data de Entrega: '.$row->DataEntrega.'</p>
									
									</div>
							</div>	
								</li>
								
							</a>

						';
					
					}


//					print 'id '.$row->ID.' cliente '.$row->ID_Cliente.' produto '.$row->ID_Produtos;
					
                }    
				
				print '</ul>';
				

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