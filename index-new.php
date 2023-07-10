
<!DOCTYPE html>

<html lang="pt-BR">

    <?php 

         include('connect.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="page-index">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>

            
			<?php 
						
				if($_SESSION['papel'] == 'admin' || $_SESSION['papel'] == 'colaborador'){
					
					$sql_code = "SELECT * FROM pedido";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadePedidos = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM pedido WHERE status='Entregue'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadePedidosEntregues = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM pedido WHERE status='Em Transito'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadePedidosTransito = $sql_query->num_rows;

					$sql_code = "SELECT * FROM usuario  WHERE papel='cliente'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadeUsuarios = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM usuario  WHERE papel='admin'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadeAdmins = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM produtos";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadeProdutos = $sql_query->num_rows;

					
					print '
					
					
					<section class="text-center painel-adm">
					
						<h2>Painel Administrativo</h2>
						
						
						<div class="flex flex-wrap justify-content-center">
						
							<div class="vendas col-33 card">
							
								<div>
								
									<h3>Vendas</h3>
									<p>Total: '.$quantidadePedidos.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/sales-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							<div class="clientes col-33 card">
							
								<div>
								
									<h3>Clientes</h3>
									<p>Total: '.$quantidadeUsuarios.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/client-icon.png">
								
								
								</div>
								
								
								
							</div>	



							<div class="produtos col-33 card">
							
								<div>
								
									<h3>Produtos</h3>
									<p>Total: '.$quantidadeProdutos.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/product-icon.png">
								
								
								</div>
								
								
								
							</div>	

							
						</div>	

					
					</section>
					
					<section class="text-center painel-adm">
					
						<h2>Pedidos</h2>
						
						
						<div class="flex flex-wrap justify-content-center">
						
							<div class="vendas col-33 card">
							
								<div>
								
									<h3>Pedidos</h3>
									<p>Total: '.$quantidadePedidos.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/total-sales-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							<div class="clientes col-33 card">
							
								<div>
								
									<h3>Pedidos Entregues</h3>
									<p>Total: '.$quantidadePedidosEntregues.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/delivery-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							<div class="produtos col-33 card">
							
								<div>
								
									<h3>Pedidos Pendentes</h3>
									<p>Total: '.$quantidadePedidosTransito.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/pendant-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							
													
						</div>	
						
						
						<a class="btn btn-primary" href="vendas.php" title="Clique nesse botão para ver mais pedidos">Ver Pedidos</a>
						
					
					
					</section>
					
					
					
					<section class="text-center painel-users painel-adm">
					
						<h2>Usuários</h2>
						
						<div class="flex flex-wrap justify-content-center">
						
							<div class="vendas col-33 card">
							
								<div>
								
									<h3>Administradores</h3>
									<p>Total: '.$quantidadeAdmins.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/admin-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							
							<div class="clientes col-33 card">
							
								<div>
								
									<h3>Clientes</h3>
									<p>Total: '.$quantidadeUsuarios.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/client-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
						</div>	
					
						<a class="btn btn-primary" href="panel-users.php" title="Clique nesse botão para ver o painel de usuários">Painel de Usuários</a>
					
					
					</section>
					

					';


					$sql_code = "SELECT ID_Cliente, COUNT(*) AS total_compras
					FROM pedido
					GROUP BY ID_Cliente
					ORDER BY total_compras DESC
					LIMIT 10;
					";
	
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);	

					print '<section class="text-center painel-users painel-adm">
					
					<h2 class="full-width text-center">Melhores Clientes</h2>
					
					<div class="flex flex-wrap justify-content-center">';

	
						while($pedido = $sql_query->fetch_object()){	
		
							$sql_code2 = "SELECT * from usuario WHERE id=".$pedido->ID_Cliente;
		
							$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
		
							$user = $sql_query2->fetch_object();

								print '				
									<div class="col-33 card flex-wrap">

										<div class="icon">

										';
										
										if($user->avatar != ''){

											print '<img src="img/users/'.$user->avatar.'.'.$user->extensao.'" style="border-radius: 100%">';

										}

										else{

											print '<img src="img/user.png">';

										}


										print'
										
										
										</div>
									


										<div>
										
											<p>Nome: '.$user->nome.'</p>
											<p>E-mail: '.$user->email.'</p>
											<p>Telefone: '.$user->telefone.'</p>

										
										
										</div>
										
										<div class="full-width actions">
										
											<a class="btn btn-primary" href="new-user-admin.php?id='.$user->id.'" title="Ver usuário">Ver</a>
										
										
										</div>
										
										

										
									</div>	
															
								
							
							';

						}

						print '
						</div>	
						
						</section>';
					
					
				}
			
			
			?>


				<?php
				
				
				// $sql_code = "SELECT ID_Cliente, COUNT(*) AS total_compras
				// FROM pedido
				// GROUP BY ID_Cliente
				// ORDER BY total_compras DESC
				// LIMIT 10;
				// ";

				// $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


				// while($pedido = $sql_query->fetch_object()){


				// 	$sql_code2 = "SELECT * from usuario WHERE id=".$pedido->ID_Cliente;

				// 	$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);

				// 	$user = $sql_query2->fetch_object();

				// 	print 'Nome: '.$user->nome.'<br>';



				// 	print $pedido->ID_Cliente.'<br>';

				// }

				// print 'Deu certo';

				
				
				?>
			
			
			
			<?php
			
			if($_SESSION['papel'] == 'cliente' || !isset($_SESSION['papel'])){
				
			?>
			
			
			<section class="flex justify-content-center">

                
				<div class="banner full-width">

					<img src="img/home/banner.jpg" alt="Banner" style="max-width: 100%;">

				</div>
				
			
			
			</section>



			<?php
			
			}
				
			?>

			<?php 

				include('footer.php');

			?>


        </div>
        



    </body>



</html>