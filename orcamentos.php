<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect-colaborador.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="page-vendas" class='page-cards'>

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<section class="flex flex-wrap">

			<?php 
		

				$sql_code = "SELECT * FROM orcamentos";

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
			
				$quantidade = $sql_query->num_rows;

				if(!isset($_GET['page'])){

					$sql_code = "SELECT * FROM orcamentos ORDER BY id DESC LIMIT 0, 10";
			
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
			
				}
			
				else{
			
					$page = intval($_GET['page']) - 1;
			
					$sql_code = "SELECT * FROM orcamentos ORDER BY id DESC LIMIT ".$page."0, 10";
			
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
			
			
				}

				// $quantidade = $sql_query->num_rows;
				
				print '
				
					<h1 class="text-center full-width">Orçamentos</h1>
					
					<ul class="full-width flex justify-content-center">

					<table border="1" class="content opened">
						<tr>
							<td>Data</td>
							<td>Nome</td>
							<td>Telefone</td>
							<td>Serviço</td>
							<td>Endereço</td>
						</tr>
		
				';
								

 				while($orcamento = $sql_query->fetch_object()){
/*
					print '
					
						<li class="flex card justify-content-space-betwen flex-wrap">

				
							<div class="date">

								<span>
							
									'.$row->data_orcamento.'

								</span>
								
							</div>	

							<div>
							
								'.$row->nome.'
								
							</div>	

                            <div>
							
								'.$row->telefone.'
								
							</div>	

                            <div>
                                    
                                '.$row->servico.'
                                
                            </div>	

                            <div>

                                Endereço:
                                
                                '.$row->logradouro.', 
                                
                         
                                
                                '.$row->numero.', 
                                
                        
                                '.$row->bairro.', 
                                
                        
                                
                                '.$row->cidade.', 
                                
                    
                                
                                '.$row->pais.',

                                '.$row->referencia.'

                                
                            </div>	

                            
                           
							
							
							
							
							
						</li>

					';
*/


					print 

                        '                        
                            <tr>
								<td>'.$orcamento->data_orcamento.'</td>

                                <td>'.$orcamento->nome.'</td>

                                <td>'.$orcamento->telefone.'</td>

								<td>'.$orcamento->servico.'</td>
								
								<td>
	
									
									'.$orcamento->logradouro.', 
									
									'.$orcamento->numero.', 
							
									'.$orcamento->bairro.', 						
									
									'.$orcamento->cidade.',					
									
									'.$orcamento->pais.',
	
									'.$orcamento->referencia.'	
									
								</td>


                            </tr>                            
                            
                        ';
                }    	
				
				print '							</table>
			';
				
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