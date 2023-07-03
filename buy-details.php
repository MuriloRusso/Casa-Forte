<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="buy-details">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<section>

			<?php 
				
				
				
				$sql_code = "SELECT * FROM pedido WHERE ID='{$_GET['id']}'";	
				
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
//				$quantidadePedidos = $sql_query->num_rows;
				
				print '<ul class="card">
				
					<h1>Detalhes da Compra</h1>
				
				';
				
				

 				while($row = $sql_query->fetch_object()){
					
					
					if($row->ID_Cliente == $_SESSION['id']){
						
						$idProduto = $row->ID_Produtos;
										
						$sql_code2 = "SELECT * FROM produtos WHERE id='{$idProduto}'";

						$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
						
						
						while($produto = $sql_query2->fetch_object()){

							print '

								<img src="img/products/'.$produto->arquivo.$produto->extensao.'"><h2>'.$produto->nome.'</h2>
								
								<p>'.$produto->descricao.'</p>


							';

						}
	//
						
					}
					
					
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